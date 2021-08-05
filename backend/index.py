import schedule
from app import Face
from app import schedule_jods
from app import dbr
from app import Syn_redis_to_db
from app import app
from datetime import datetime

app.logger.info("run app")

app.logger.info("initialization face")

face = Face()

app.logger.info("initialization Syn_redis_to_db")
syn_redis_to_db = Syn_redis_to_db()


def update_syn_redis_to_db():
    syn_redis_to_db = Syn_redis_to_db()


def synRedis2mysql():
    app.logger.info("synRedis2Mysql")
    syn_redis_to_db.syn()

schedule.every(1).minutes.do(synRedis2mysql)

# schedule.every().day.at("21:22").do(face.recognize)

schedule.every().day.at("00:00").do(update_syn_redis_to_db)

schedule.every().day.at("00:10").do(dbr.flushall)

schedule_jods(schedule)

print("face.recognize")
face.recognize()