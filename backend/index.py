import schedule
import threading
from app import Face
import time
from app import schedule_jods
from app import dbr
from app import Syn_redis_to_db
from datetime import datetime

print("run")

print("initialization face")
face = Face()

print("initialization Syn_redis_to_db")
syn_redis_to_db = Syn_redis_to_db()

def update_syn_redis_to_db():
    syn_redis_to_db = Syn_redis_to_db()

def synredis2mysql():
    print("synredis2mysql")
    print(datetime.now())
    syn_redis_to_db.syn()

print("face.recognize")

schedule.every(1).minutes.do( synredis2mysql )

schedule.every().day.at("00:30").do(face.recognize)

schedule.every().day.at("00:00").do(update_syn_redis_to_db)

schedule.every().day.at("00:10").do(dbr.flushall)

schedule_jods(schedule)

