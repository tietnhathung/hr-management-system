import cv2

def show_image(image,face_poits):
    for face_poit in face_poits:
        (startX, startY, endX, endY) = face_poit.astype("int")
        face_image = image[startY:endY, startX:endX]
        cv2.imshow("Frame", face_image)
        cv2.waitKey()
