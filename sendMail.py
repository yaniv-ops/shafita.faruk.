import os
import urllib.parse


sent_query = os.environ['QUERY_STRING']
query_list = sent_query.split('=')
query_dict = urllib.parse.parse_qs(os.environ['QUERY_STRING'])

def sendMail(name, urname, subject, msg):
    return(f"Hello {str(name).capitalize()}  {str(urname).capitalize()}")

input_name = str(query_dict['name'])[2:-2]
input_urname = str(query_dict['urname'])[2:-2]


print("Content-Type: text/html\n")
print(str(sendMail(input_name, input_urname)))