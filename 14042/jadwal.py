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
url="http://jadwalevent.web.id/tag/jadwal-acara-bandung/feed"

#geturl
r= requests.get(url)

#get content in xml
soup = BeautifulSoup(r.content,"lxml") 

#mendefinisikan variabel general data
g_data = soup.find_all("item") 


#create jadwal table
cursor = db.cursor()
cursor.execute("DROP TABLE IF EXISTS jadwal")
sql = """CREATE TABLE jadwal ( 
			JUDUL varchar(255) NOT NULL,
			TANGGAL varchar(255) NOT NULL,
			TEMPAT varchar(255) NOT NULL,
			PRIMARY KEY(JUDUL))""" 
cursor.execute(sql)
0L

#inserting general data
for item in g_data:
	a=item.find_all("title")[0].text
	b=item.find_all("p")[0].text
	c=item.find_all("p")[1].text+'\n'
 	try:
		cursor.execute("""INSERT INTO jadwal VALUES (%s,%s,%s)""",(a,b,c))
		db.commit()
	except:     
		db.rollback()	
1L

db.close()
