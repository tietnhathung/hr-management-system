from configparser import ConfigParser
import os

ROOT_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

config = ConfigParser(interpolation=None)
config.read(os.path.join(ROOT_DIR, 'config.ini'))
