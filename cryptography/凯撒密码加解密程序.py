#------李梦洋----2020.3.7----17计算机2班
import re

def testCipher():
     #密文合法判断
    while True:
        cipher= input("请输入密文:")
        cipher= cipher.lower()#把密文全部替换为小写字符
        cipher1=re.match("[a-z]*",cipher).group()
        if(cipher1!=cipher):
            print("密文只能是字母")
            continue
        else:break
    return cipher

def testPlain():
     #明文合法判断
    while True:
        plain= input("请输入明文:")
        plain= plain.lower()
        plain1=re.match("[a-z]*",plain).group()
        if(plain1!=plain):
            print("密文只能是字母")
            continue
        else:break
    return plain

def testKey():
    #密钥合法判断
    while True:
        try:
            key =int(input("请输入位移值:"))
        except:
            print("位移值错误")
        else:
            key=int(key)%26
            break        
    return key


def de(cipher,key):
    #解密算法分别为密文和深度
    i=0
    while i<len(cipher):
        #进入遍历 a-z:97-122
        ord1=int(ord(cipher[i])-key)
        if(ord1<97):
            cipher=cipher[:i]+chr(ord1+26)+cipher[i+1:]
            i+=1
            continue
        if(ord1<=122):
            cipher=cipher[:i]+chr(ord1)+cipher[i+1:] 
            i+=1   
            continue
        if(ord1>122):
            cipher=cipher[:i]+chr(ord1-26)+cipher[i+1:] 
            i+=1   
        #遍历完成
    return cipher

def en():
    #加密算法
    plain=testPlain()
    key=testKey()
    i=0
    while i<len(plain):
        #进入遍历 a-z:97-122
        ord1=int(ord(plain[i])+key)
        if(ord1>122):
            plain=plain[:i]+chr(ord1-26)+plain[i+1:]
            i+=1
            continue
        if(ord1>=97):
            plain=plain[:i]+chr(ord1)+plain[i+1:]    
            i+=1
            continue
        if(ord1<97):
            plain=plain[:i]+chr(ord1+26)+plain[i+1:]    
            i+=1
        #遍历完成
    return plain
    
def mj():
    cipher=testCipher()
    j=1
    while j<26:
        print("位移为",j,"的结果为",de(cipher,j))
        j+=1
    print("如果有读的通的句子，则该条有大概率为明文")
                   

while True:
    print("凯撒密码加解密py小程序")
    print("1. 加密 2.指定k解密 3.枚举解密")
    choice = input("请选择:")
    if choice == "1":print("加密后为：",en())
    elif choice == "2": 
        key=testKey()
        cipher=testCipher()
        plaint=de(cipher,key)
        print("解密后为：",plaint)
    elif choice == "3": mj()
    else: print ("您的输入有误!")
