import requests
import sys
import time

url=str(sys.argv[1])
req= requests.get(url)
data_str=req.text
str1='<input type="hidden" name="op" value="'
str2='<input type="hidden" name="id" value="'
str3='<input type="hidden" name="fname" value="'
str_title='<h1>Watch video: '
end ='"'
end_title_str='</h1>'
start1=data_str.find(str1)
start2=data_str.find(str2)
start3=data_str.find(str3)
if ((start1 != -1) and (start2 != -1) and (start3 != -1)):
 start1+=len(str1)
 start2+=len(str2)
 start3+=len(str3)
 start_title=data_str.find(str_title)+len(str_title)
 end1=data_str.find(end,start1)
 end2=data_str.find(end,start2)
 end3=data_str.find(end,start3)
 end_title=data_str.find(end_title_str,start_title)
 value1=data_str[start1:end1]
 value2=data_str[start2:end2]
 value3=data_str[start3:end3]
 title=data_str[start_title:end_title]
 payload = {'op': value1, 'id': value2, 'fname': value3, 'imhuman': 'Watch video now'}
 time.sleep(11)
 req = requests.post(url, data=payload)
 data_str=req.text
 final_str='file: "'
 final_start=data_str.find(final_str)
 if (final_start != -1):
  final_start+=len(final_str)
  final_end=data_str.find(end,final_start)
  link=data_str[final_start:final_end]
  print title+"\n"+link
