from app import db
from sqlalchemy import Column,String,Integer,Boolean
from sqlalchemy.orm import relationship

class User(db.Model):
    __tablename__ = "users"
    id = Column(Integer,primary_key=True,autoincrement=True)
    username = Column(String(255))
    name = Column(String(191))
    fullname = Column(String(255))
    email = Column(String(191))
    password = Column(String(191))
    address = Column(String(255))
    status = Column(Boolean)
    timekeeping = relationship('Timekeeping',backref='user',lazy=True)

    def __str__(self):
        return f'username: {self.username}, fullname: {self.fullname}, id: {self.id}'

