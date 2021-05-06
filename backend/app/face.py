import time
import cv2
import imutils
import os
from imutils.video import VideoStream
from datetime import datetime
import pickle
import numpy as np
from sklearn.preprocessing import LabelEncoder
from sklearn.svm import SVC
from app import config
from app import ROOT_DIR
from app import dbr

class Face:
    caffeDetector = None
    torchEmbedder = None

    def __init__(self):
        protoCaffePath = os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'] , 'deploy.prototxt')
        modelCaffePath = os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'] , 'res10_300x300_ssd_iter_140000.caffemodel')
        self.caffeDetector = cv2.dnn.readNetFromCaffe(protoCaffePath, modelCaffePath)
        modelTorchPath = os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'] , 'openface_nn4.small2.v1.t7')
        self.torchEmbedder = cv2.dnn.readNetFromTorch(modelTorchPath)


    def Recognition(self,image):
        (height, width) = image.shape[:2]

        imageBlob = cv2.dnn.blobFromImage(cv2.resize(image, (300, 300)), 1.0, (300, 300), (104.0, 177.0, 123.0),swapRB=False, crop=False)
        self.caffeDetector.setInput(imageBlob)
        detections = self.caffeDetector.forward()

        list_faces = detections[0, 0]

        filter = np.greater(list_faces[:,2], float(config['FACE']['Confidence']) )

        list_poit_faces = list_faces[filter, 2:7] * np.array([1,width, height, width, height])

        return list_poit_faces

    def Face_vec(self,image,box):
        if box.any():
            if(isinstance(box[0], np.ndarray)):
                list_vec_faces = []
                list_poit_faces = box

                for poit_face in list_poit_faces:
                    (startX, startY, endX, endY) = poit_face.astype("int")

                    face_image = image[startY:endY, startX:endX]

                    (fH, fW) = face_image.shape[:2]

                    if fW < 20 or fH < 20:
                        continue

                    faceBlob = cv2.dnn.blobFromImage(face_image, 1.0 / 255, (96, 96), (0, 0, 0), swapRB=True, crop=False)
                    self.torchEmbedder.setInput(faceBlob)
                    vec = self.torchEmbedder.forward()
                    list_vec_faces.append(vec)
                return list_vec_faces
            else:
                poit_faces = box
                (startX, startY, endX, endY) = poit_faces.astype("int")
                face_image = image[startY:endY, startX:endX]
                (fH, fW) = face_image.shape[:2]
                if fW < 20 or fH < 20:
                    return []
                faceBlob = cv2.dnn.blobFromImage(face_image, 1.0 / 255, (96, 96), (0, 0, 0), swapRB=True, crop=False)
                self.torchEmbedder.setInput(faceBlob)
                return self.torchEmbedder.forward()
        return []

    def Retraining(self):
        print("start retraining....")
        try:
            EmbeddingsFile = open(  os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'],config['DEFAULT']['EmbeddingsFile']) , "rb").read()
            data = pickle.loads(EmbeddingsFile)
            le = LabelEncoder()
            labels = le.fit_transform(data["names"])
            recognizer = SVC(C=1.0, kernel="linear", probability=True)
            recognizer.fit(data["embeddings"], labels)
            f = open( os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'],config['DEFAULT']['RecognizerFile']) , "wb")
            f.write(pickle.dumps(recognizer))
            f.close()
            f = open(  os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'],config['DEFAULT']['LeFile']) , "wb")
            f.write(pickle.dumps(le))
            f.close()
            print("traning success")
        except:
            print("Open file data failure")

        print("end retraining")

    def recognize(self):
        modelrecognizerPath = os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'] , 'recognizer.pickle')
        recognizer = pickle.loads(open(modelrecognizerPath, "rb").read())
        lePath = os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'] , 'le.pickle')
        le = pickle.loads(open(lePath, "rb").read())
        working_date = datetime.now()
        video = VideoStream(src=0).start()
        time.sleep(2.0)
        while working_date.strftime(config['TIME']['DateFormat']) == datetime.now().strftime(config['TIME']['DateFormat']):
            now = datetime.now().strftime(config['TIME']['DateTimeFormat'])
            frame = video.read()
            frame_w600 = imutils.resize(frame, width=600)
            list_poit_faces = self.Recognition(frame_w600)
            box = list_poit_faces[:,1:]
            list_poit_faces_vec = self.Face_vec(frame_w600,box)
            for vec in list_poit_faces_vec:
                max = recognizer.predict(vec)[0]
                name = le.classes_[max]
                if not name == '0':
                    time_re = working_date.strftime(config['TIME']['DateFormatRedis'])
                    key_on  = 'timekeeping.{}.{}.get_to_work'.format(time_re,name)
                    key_off  = 'timekeeping.{}.{}.get_off_work'.format(time_re,name)
                    if not dbr.exists(key_on):
                        dbr.set(key_on, now)
                    dbr.set(key_off, now)

        video.stop()

