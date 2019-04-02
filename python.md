# Here  I will record my process of learning of python
##   **的用法 
#### \*\*类似于^幂运算  例如 3**2 = 9<br>
#### 但是需要注意的是在python优先级中 需要注意幂运算的优先级  例如 -3**2 = -9  ,如果需要得到想要的结果 ,则需改变成 (-3)**2   而 3**-2 与 3**(-2)的结果是一样的 ,<br>即 `幂运算中负号的优先级一般右侧要比左侧的高`
## for循环的用法
### 语法:
```Python
		for 目标 in 表达式 :
			循环体
			```
### for经常与range()一起使用
```Python
		for i in range(5):
			print(i)
0 1 2 3 4
```
```Python
range(2,9)

2 3 4 5 6 7 8  #注意这里没有9
```
```Python
range(2,9,2)
2 4 6 8  #第三个参数类似于 i=i+2
```
## 列表
### 在python中,列表类似于C的数组,却更像是打了激素的数组,
<br>例如
```Python
mix =[1,2,'123',[1,2,3]]
```
