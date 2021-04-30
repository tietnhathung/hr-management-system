import threading
import time
def schedule_jods(schedule_jod):
    cease_continuous_run = threading.Event()
    class ScheduleThread(threading.Thread):
        @classmethod
        def run(cls):
            while not cease_continuous_run.is_set():
                schedule_jod.run_pending()
    continuous_thread = ScheduleThread()
    continuous_thread.start()
    return cease_continuous_run