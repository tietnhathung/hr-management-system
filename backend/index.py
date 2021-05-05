from app.face import Face
import cv2
import schedule
from datetime import datetime
from app import schedule_jods
from app import dbr
from app import db
from app.model.user import User
from app.model.timekeeping import Timekeeping
from app import config


now = datetime.now()

timekeeping  =  Timekeeping.query.filter_by( working_day = now.strftime(config['DEFAULT']['DateFormat']) ).all()

for ti in timekeeping:
    print(ti.user)
