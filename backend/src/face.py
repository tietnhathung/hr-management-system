import cv2
import imutils
import os
import numpy as np
from src.config import config

ROOT_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

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





