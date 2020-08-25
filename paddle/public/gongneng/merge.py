# coding: utf8
import requests
import json
import base64
import os
import sys
import cv2
import string
import random
from PIL import Image
import numpy as np
image = sys.argv[1]
image2 = sys.argv[2]
def hebing(image,image2):
    base_image = Image.open(image2).convert('RGB')
    fore_image = Image.open("output/"+image).resize(base_image.size)

    # 图片加权合成
    scope_map = np.array(fore_image)[:,:,-1] / 255
    scope_map = scope_map[:,:,np.newaxis]
    scope_map = np.repeat(scope_map, repeats=3, axis=2)
    res_image = np.multiply(scope_map, np.array(fore_image)[:,:,:3]) + np.multiply((1-scope_map), np.array(base_image))
    
    #截取最后一个/的位置
    image2 = image2[0:image2.rfind('/')+1]
    #随机生成32位的一个字符串当做迁移之后的文件名
    ran_str = ''.join(random.sample(string.ascii_letters + string.digits, 32))
    style = image2 + ran_str + ".jpg"
    #保存图片
    res_image = Image.fromarray(np.uint8(res_image))
    res_image.save(style)
    print(style.split('/')[-2]+"pengzhaoshuai"+style.split('/')[-1])

if __name__ == "__main__":
    # 指定要使用的图片文件并生成列表[("image", img_1), ("image", img_2), ... ]
    file_list = [image]
    files = [("image", (open(item, "rb"))) for item in file_list]
    # 指定图片分割方法为deeplabv3p_xception65_humanseg并发送post请求
    url = "http://127.0.0.1:8866/predict/image/deeplabv3p_xception65_humanseg"
    r = requests.post(url=url, files=files)

    # 保存分割后的图片到output文件夹，打印模型输出结果
    if not os.path.exists("output"):
        os.mkdir("output")

    results = eval(r.json()["results"])
    for item in results:
        with open(
                os.path.join("output", item["processed"].split("/")[-1]),
                "wb") as fp:
            fp.write(base64.b64decode(item["base64"].split(',')[-1]))
            item.pop("base64")
    str = json.dumps(results[0]['processed'], indent=4, ensure_ascii=False)
    str = str.replace("\"", "")
    koutu = str.replace("\\\\", "/")
    hebing(koutu,image2)


