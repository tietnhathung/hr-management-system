import cv2

def show_image(image,face_poits):
    for face_poit in face_poits:
        (startX, startY, endX, endY) = face_poit.astype("int")
        cv2.rectangle(image, (startX,startY ), (endX, endY), (0, 255, 0), 3)
    cv2.imshow("Frame", image)
    cv2.waitKey(1)
