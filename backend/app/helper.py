import cv2

def show_image(image,face_poit):
    (startX, startY, endX, endY) = face_poit.astype("int")
    face_image = image[startY:endY, startX:endX]
    cv2.imshow("Frame", face_image)
    cv2.waitKey()
