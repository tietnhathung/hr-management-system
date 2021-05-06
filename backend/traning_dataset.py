from app import Face
from app import config
from app import ROOT_DIR
import cv2
from imutils import paths
import os
import numpy as np
import pickle
face = Face()

imagePaths = list(paths.list_images(config['DEFAULT']['DatasetDir']))

knownNames = []
knownEmbeddings = []

for (i, imagePath) in enumerate(imagePaths):
    name = imagePath.split(os.path.sep)[-2]
    image = cv2.imread(imagePath)
    detections = face.Recognition(image)

    if (len(detections) > 0):
        max_poit = np.argmax(detections[ : , 0])
        box = detections[max_poit ,1:]

        vec = face.Face_vec(image,box)

        if(len(vec)==1):
            knownNames.append(name)
            knownEmbeddings.append(vec.flatten())

data = {"embeddings": knownEmbeddings, "names": knownNames}

f = open( os.path.join(ROOT_DIR, config['DEFAULT']['ModelDir'],config['DEFAULT']['EmbeddingsFile']) , "wb")
f.write(pickle.dumps(data))
f.close()
print("setup data success")