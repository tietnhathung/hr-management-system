import cv2

def show_image(image):
    cv2.imshow("Frame", image)
    cv2.waitKey(1)
