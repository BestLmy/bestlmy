## No——Gui的抓包分析工具

### 抓包指令   
默认只抓68个字节
```
tcpdump -i eth0 -s 0 -w file.pcap   # -i 指定接口  -s size 0 表示抓取所有大小的包  -w 保存到指定的文件
tcpdump -i eth0 port 22    #抓取22端口的所有包
```
#### -n  不对包内的ip地址进行域名解析
#### 重定向 |awk'{print $3}'  仅显示第三列的数据
#### 重定向 | sort -u  去除重复的数据
### 读取抓包文件
```
tcpdump -（A/X）r file.pcap  #r= read A =二进制 X=十六进制
```
