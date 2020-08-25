import requests
import json
import cv2
import base64
import random
import string
import sys
import numpy as np
image = sys.argv[1]
style = sys.argv[2]
def cv2_to_base64(image):
    data = cv2.imencode('.jpg', image)[1]
    return base64.b64encode(data.tostring()).decode('utf8')

def base64_to_cv2(b64str):
    data = base64.b64decode(b64str.encode('utf8'))
    data = np.frombuffer(data, np.uint8)
    data = cv2.imdecode(data, cv2.IMREAD_COLOR)
    return data

data = {'images':[
    {
        'content':cv2_to_base64(cv2.imread(image)),
        'styles':[cv2_to_base64(cv2.imread(style))]
    }
]}

headers = {"Content-type": "application/json"}
url = "http://127.0.0.1:8866/predict/stylepro_artistic"
r = requests.post(url=url, headers=headers, data=json.dumps(data))
#截取最后一个/的位置
num = style[0:style.rfind('/')+1]
#随机生成32位的一个字符串当做迁移之后的文件名
ran_str = ''.join(random.sample(string.ascii_letters + string.digits, 32))
style = num + ran_str + ".jpg"
cv2.imwrite(style, base64_to_cv2(r.json()["results"][0]['data']))
print(style.split('/')[-2]+"pengzhaoshuai"+style.split('/')[-1])