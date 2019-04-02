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
## 给列表中添加元素的方法
1.append()  
```Python
mix.append("李梦洋")	#append每次只能加`一个元素`进入到列表中去
```
2.extend()
```Python
mix.extend(["12","133"])	#extend每次只能加入一个列表进入到列表中去,即extend的参数只能是一个`列表`
```
`注意:append 和 extend 两个方法都是将元素添加到列表的最后位置`
3.insert()
```Python
mix.insert(0,"123") #第一个参数表示添加元素在列表中的位置,第二个参数表示添加的元素
```
## 从列表中获取元素
```Python
mix[0]
```
## 从列表中删除元素
1.remove()
```Python
mix.remove("李梦洋")  #不需要知道元素在列表中的位置
```
