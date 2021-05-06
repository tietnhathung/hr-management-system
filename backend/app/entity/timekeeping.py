from app import db
from sqlalchemy import Column,Integer,DateTime,ForeignKey
from app.entity import User

class Timekeeping(db.Model):

    __tablename__ = "timekeeping"
    id = Column(Integer, primary_key=True, autoincrement=True)
    user_id = Column(Integer,ForeignKey(User.id),nullable=False)
    get_to_work = Column(DateTime)
    get_off_work = Column(DateTime)
    working_day = Column(DateTime)

    def __init__(self,user_id,get_to_work,get_off_work,working_day):
        self.user_id = user_id
        self.get_to_work = get_to_work
        self.get_off_work = get_off_work
        self.working_day = working_day

    def __str__(self):
        return f'user_id: {self.user_id}, get_to_work:{self.get_to_work}, get_off_work: {self.get_off_work}, working_day:{self.working_day}'