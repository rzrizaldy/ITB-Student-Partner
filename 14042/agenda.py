#Siti Aisyah/18214042
#mengambil data dari agenda itb

#import requests library
import requests

#import library MySQLdb
import MySQLdb

#import Beautiful Soup Library
from bs4 import BeautifulSoup

#connect db
db = MySQLdb.connect("sql10.freemysqlhosting.net","sql10148878","TFZ3y5WX6H","sql10148878" ) 

#url yang akan diambil datanya
url="https://www.itb.ac.id/agenda/rss"

#geturl
r= requests.get(url)

#get content in xml
soup = BeautifulSoup(r.content,"lxml") 

#mendefinisikan variabel general data
g_data = soup.find_all("item") 


#create agenda table
cursor = db.cursor()
cursor.execute("DROP TABLE IF EXISTS agenda")
sql = """CREATE TABLE agenda ( 
			JUDUL varchar(100) NOT NULL,
			KETERANGAN varchar(1000) NOT NULL,
			PRIMARY KEY(JUDUL))"""
cursor.execute(sql)
0L

#inserting general data
for item in g_data:
	a=item.find_all("title")[0].text
	b=item.find_all("description")[0].text.replace(' | ', '\n').replace('...','\n')
 	try:
		cursor.execute("""INSERT INTO agenda VALUES (%s,%s)""",(a,b))
		db.commit()
	except:     
		db.rollback()	
1L

db.close()

