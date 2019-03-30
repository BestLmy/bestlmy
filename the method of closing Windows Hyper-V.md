# Hyper-V介绍
Hyper-V是微软提出的一种系统管理程序虚拟化技术，能够实现桌面虚拟化,类似于VMware ,<br>在Windows中可以嵌入Linux操作系统,以及在1903版本后出现的windows sandbox应用.<br>但是Hyper-V与一些软件譬如VMware以及一些安卓模拟器是冲突的,所以有时候需要关闭它.
# Hyper-V的打开方法
### 1.在windows7或者windows10操作系统中,打开控制面板里的程序与功能<br><br>
![打开方法](http://a1.qpic.cn/psb?/V10RGgSt4cM7cR/xtV3jjBnUzJTIHj63DjdbD7HRvfCjIYcURRusSLw8cM!/c/dFQBAAAAAAAA&ek=1&kp=1&pt=0&bo=cwSBAnMEgQIDGTw!&tl=1&vuin=283738217&tm=1553929200&sce=60-2-2&rf=0-0)<br><br>
### 2.在功能中查找到Hyper-V的选项<br><br>
![查找选项](http://a1.qpic.cn/psb?/V10RGgSt4cM7cR/GNBhmzGs1WGcUkQSBPllrIuYjSbi2x4mSi0Vqfm3YhY!/c/dMAAAAAAAAAA&ek=1&kp=1&pt=0&bo=lQGhAZUBoQEDGTw!&tl=1&vuin=283738217&tm=1553929200&sce=60-2-2&rf=0-0)<br><br>
### 3.选择打上对勾即可打开Hyper-V<br><br>
# Hyper-V的关闭方法
### 1.在打开方法中的第二步选择取消对勾,并确定<br><br>
### 2.重启计算机,如果发现仍然提示关闭功能,则执行第三步<br><br>
### 3.利用win+R快捷键打开运行框,输入regedit打开注册表编辑。<br><br>
### 4.在注册表中找到：<br>` HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Control\DeviceGuard\Scenarios\HypervisorEnforcedCodeIntegrity `
<br>
### 然后将Enabled改成0，修改完成后重启电脑即可.<br>
