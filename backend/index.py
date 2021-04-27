from configparser import ConfigParser
from src.face import Face
import cv2

config = ConfigParser()
config.read('config.ini')

face = Face()

image = cv2.imread('./images/test1.jpg')

face.set_image(image)

list_vec_faces = face.Face_vec()

print(list_vec_faces)






