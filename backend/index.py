from src.face import Face
import cv2
import schedule
from datetime import datetime
from src.schedule_jod import schedule_jods


def job():
    now = datetime.now()
    current_time = now.strftime("%H:%M:%S")
    print("I'm working...Current Time =",current_time)

def job2():
    print("job2 working...")


schedule.every(10).seconds.do(job)
schedule.every(30).seconds.do(job2)

stop_run_continuously = schedule_jods(schedule)

