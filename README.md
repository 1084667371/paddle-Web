# 手把手带你搭建paddlehub的web服务端(可视化)

> 项目链接：[手把手带你搭建paddlehub的web服务端(可视化)](https://aistudio.baidu.com/aistudio/projectdetail/528354)

首先呢先来介绍一下何为paddlehub

paddlehub：便捷地获取PaddlePaddle生态下的预训练模型，完成模型的管理和一键预测。配合使用Fine-tune API，可以基于大规模预训练模型快速完成迁移学习，让预训练模型能更好地服务于用户特定场景的应用
接下来大家一起来看看吧，看完保证你会搭建paddlehub的web服务端。
# 我们来看一下我们WEB服务可以实现的效果
## 一、一键抠图
我们有时候想把照片中的人像抠出来，是不是还需要打开ps呢？还要一点一点的去抠图。大家看下面这个的效果，符不符合你的要求呢？
### deeplabv3p_xception65_humanseg
DeepLabv3+ 是Google DeepLab语义分割系列网络的最新作，其前作有 DeepLabv1, DeepLabv2, DeepLabv3。在最新作中，作者通过encoder-decoder进行多尺度信息的融合，同时保留了原来的空洞卷积和ASSP层， 其骨干网络使用了Xception模型，提高了语义分割的健壮性和运行速率，在 PASCAL VOC 2012 dataset取得新的state-of-art performance。该PaddleHub Module使用百度自建数据集进行训练，可用于人像分割，支持任意大小的图片输入。
[deeplabv3p_xception65_humanseg文档链接](https://www.paddlepaddle.org.cn/hubdetail?name=deeplabv3p_xception65_humanseg&en_category=ImageSegmentation)

![](https://ai-studio-static-online.cdn.bcebos.com/39c6b1a98ac445ce9a52af64ff1ddcc419ab341ec88d43c1b39a6fbbd261fe10)
## 二、风格迁移
你有多久没有换过你的QQ、微信头像了呢？看看下面这个效果，是不是有一种想把头像风格化的心情，哈哈。
### stylepro_artistic
艺术风格迁移模型可以将给定的图像转换为任意的艺术风格。本模型StyleProNet整体采用全卷积神经网络架构(FCNs)，通过encoder-decoder重建艺术风格图片。StyleProNet的核心是无参数化的内容-风格融合算法Style Projection，模型规模小，响应速度快。模型训练的损失函数包含style loss、content perceptual loss以及content KL loss，确保模型高保真还原内容图片的语义细节信息与风格图片的风格信息。预训练数据集采用MS-COCO数据集作为内容端图像，WikiArt数据集作为风格端图像。
[stylepro_artistic文档链接](https://www.paddlepaddle.org.cn/hubdetail?name=stylepro_artistic&en_category=GANs)

![](https://ai-studio-static-online.cdn.bcebos.com/c2c92a997cfe496ca28f8aa0d4152daa86fc334cd4dc4c78b03fdc13286b22d3)
![](https://ai-studio-static-online.cdn.bcebos.com/e8468df2cd79482f9c045616e466a96e88f78767f7ca40efbbf69bbcc46a8d11)
## 三、图像合并
小伙伴们看到这里是不是感觉，咦怎么又是这个模型呢？  哈哈  你没看错图像合并就是先用这个模型进行抠图，在进行合并的，这样大家就可以想去哪里就去哪里啦!
### deeplabv3p_xception65_humanseg
DeepLabv3+ 是Google DeepLab语义分割系列网络的最新作，其前作有 DeepLabv1, DeepLabv2, DeepLabv3。在最新作中，作者通过encoder-decoder进行多尺度信息的融合，同时保留了原来的空洞卷积和ASSP层， 其骨干网络使用了Xception模型，提高了语义分割的健壮性和运行速率，在 PASCAL VOC 2012 dataset取得新的state-of-art performance。该PaddleHub Module使用百度自建数据集进行训练，可用于人像分割，支持任意大小的图片输入。
[deeplabv3p_xception65_humanseg文档链接](https://www.paddlepaddle.org.cn/hubdetail?name=deeplabv3p_xception65_humanseg&en_category=ImageSegmentation)
![](https://ai-studio-static-online.cdn.bcebos.com/87607c5016844101927af1a01859590b11c4d2989a114e93b355f284b0e6f198)
## 四、文字识别
文字识别大家一定都非常熟悉了，不管是在我们生活中还是工作中，用到的都是非常多的，大家也可以看看效果(偷偷告诉你们连笔字效果不行，哈哈)
### chinese_ocr_db_crnn_server
chinese_ocr_db_crnn_server Module用于识别图片当中的汉字。其基于chinese_text_detection_db_server检测得到的文本框，继续识别文本框中的中文文字。识别文字算法采用CRNN（Convolutional Recurrent Neural Network）即卷积递归神经网络。其是DCNN和RNN的组合，专门用于识别图像中的序列式对象。与CTC loss配合使用，进行文字识别，可以直接从文本词级或行级的标注中学习，不需要详细的字符级的标注。该Module是一个通用的OCR模型，支持直接预测。
[chinese_ocr_db_crnn_server文档链接](https://www.paddlepaddle.org.cn/hubdetail?name=chinese_ocr_db_crnn_server&en_category=TextRecognition)

![](https://ai-studio-static-online.cdn.bcebos.com/f6fe63e126114541895e96a40e62f425e8a5f2521d6b411db81bbdb73ce685dd)
![](https://ai-studio-static-online.cdn.bcebos.com/555f62348fcc448cac9ef9e9abb9624dfff3c13f501f4c89903b1edeee458334)
