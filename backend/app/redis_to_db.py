from datetime import datetime
from app.entity import User,Timekeeping
from app import db,dbr,config,app

class Syn_redis_to_db:
    def get_list_user(self):
        list_users = User.query.all()
        if list_users is None:
            return []
        return list_users

    def get_timekeeping_user(self,user_id,working_day):
        timekeeping = Timekeeping.query.filter_by(user_id=user_id,working_day=working_day).first()
        return timekeeping

    def addNew(self,user_id ,get_to_work ,get_off_work ,working_day):
        timekeeping = Timekeeping( user_id=user_id, get_to_work=get_to_work ,get_off_work=get_off_work ,working_day=working_day)
        db.session.add(timekeeping)
        db.session.commit()

    def syn(self):
        app.logger.info("run to syn...........");
        working_date = datetime.now()
        list_users = self.get_list_user()
        for user in list_users:
            time_re = working_date.strftime(config['TIME']['DateFormatRedis'])
            key_on = 'timekeeping.{}.{}.get_to_work'.format(time_re, user.id)
            key_off = 'timekeeping.{}.{}.get_off_work'.format(time_re, user.id)
            if dbr.exists(key_on) or dbr.exists(key_off):
                working_key = datetime.now().strftime(config['TIME']['DateFormat'])
                timekeeping_of_user = self.get_timekeeping_user(user.id,working_key)
                if timekeeping_of_user is None and dbr.exists(key_on):
                    get_to_work = dbr.get(key_on)
                    get_off_work = None
                    if dbr.exists(key_off):
                        get_off_work = dbr.get(key_off)
                    self.addNew( user.id,get_to_work,get_off_work, working_key )
                elif timekeeping_of_user is not None and dbr.exists(key_off):
                    get_off_work = dbr.get(key_off)
                    timekeeping_of_user.get_off_work = get_off_work
                    db.session.commit()