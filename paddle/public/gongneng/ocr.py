import requests
import json
import cv2
import sys
import base64
image = sys.argv[1]
def cv2_to_base64(image):
    data = cv2.imencode('.jpg', image)[1]
    return base64.b64encode(data.tostring()).decode('utf8')

# 发送HTTP请求
data = {'images':[cv2_to_base64(cv2.imread(image))]}
headers = {"Content-type": "application/json"}
url = "http://127.0.0.1:8866/predict/chinese_ocr_db_crnn_server"
r = requests.post(url=url, headers=headers, data=json.dumps(data))
a = r.json()["results"][0]['data']
# 打印预测结果
zonghe = ""
for num,name in enumerate(a):
    zonghe += name['text'] + ","
name = zonghe[0:-1]
print(name)
#print(name.encode('unicode_escape').decode('ascii'))