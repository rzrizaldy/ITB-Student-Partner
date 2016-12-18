function Gizi (element,name) {
	this.name	=name;
	this.el 	= element;	//(DOM)
	this.buff	=[];		//makanan yang pernah dicari
	this.foods 	= [];		//hasil pencarian
	this.listmakan = [];	//daftar makanan dan/atau minuman dikonsumsi
	this.listcari;			//daftar pencarian (DOM)
	this.table;				//tabel makanan & minuman dikonsumsi (DOM)
	this.energi;			//energi dari makanan & minuman (DOM)
	this.bar;				//diagram energi (DOM)

	//Membuat tampilan
	this.init = function(){
		//window
		this.common("");
		this.el.setAttribute("class","gizi_window");
		this.el.style.display="none";

		this.listcari=document.createElement("div");
		this.listcari.setAttribute("style","background: #FDD835;height:80%;overflow-y: scroll;padding:3px;");

		//panel1
		panel1=document.createElement("div");
		panel1.setAttribute("class","gizi_panel1");
		//cari
		param1=document.createElement("div");
		param1.appendChild(document.createTextNode("cari"));
		panel1.appendChild(param1);
		//input
		param1=document.createElement("input");
		param1.setAttribute("style","width: 70%;margin-bottom: 10px;");
		param1.setAttribute("onchange",this.name+".tunggutampil(this)");
		//param1.setAttribute("onkeypress",this.name+".cari(this.value)");
		//param1.setAttribute("onkeypress","alert(this.value)");
		panel1.appendChild(param1);
		panel1.appendChild(this.listcari);

		//panel2
		panel2=document.createElement("div");
		panel2.setAttribute("class","gizi_panel2");
		param1=document.createElement("center");
		this.table=document.createElement("table");
		this.table.setAttribute("border","1");
		param3=document.createElement("tr");
		this.table.appendChild(param3);
		param3.outerHTML="<tr><th>Nama</th><th>Jumlah porsi</th><th>Energi/Porsi (kkal)</th><th><a>Edit</a></th></tr>";
		param1.appendChild(this.table);
		panel2.appendChild(param1);

		//panel3
		panel3=document.createElement("div");
		panel3.setAttribute("class","gizi_panel3");

		param3=document.createElement("div");
		param3.setAttribute("class", "gizi_panel_border");
		this.energi=document.createElement("span");
		this.energi.appendChild(document.createTextNode("0"));
		param3.innerHTML="<div style='background: #FDD835;margin:-5px;padding:3px;border-radius:3px 3px 0px 0px;font-weight:bold;margin-bottom:5px;'>Total Energi</div>";
		param3.appendChild(document.createTextNode("Jumlah energi : "));
		param3.appendChild(this.energi);
		param3.appendChild(document.createTextNode(" kkal"));
		this.bar=document.createElement("div");
		param3.appendChild(this.bar);
		panel3.appendChild(param3);

		param1=document.createElement("link");
		param1.setAttribute("rel","stylesheet");
		param1.setAttribute("type","text/css");
		param1.setAttribute("href","gizi.css");
		this.el.appendChild(param1);

		this.el.appendChild(panel1);
		this.el.appendChild(panel2);
		this.el.appendChild(panel3);
		this.el.style.display="inline-flex";
	
		this.bar.innerHTML=this.gizi_bar(0,0,0);
	};


	this.tunggutampil = function(a){
		this.listcari.innerHTML = "tunggu...";
		window.setTimeout(this.name+".getfoods('"+a.value+"','"+this.name+"')", 100);
	};

	this.tampil = function(a){
		//this.getfoods(a);
		isi="";
		for(b in this.foods){
			isi+="<div class='gizi_tip' onclick='"+this.name+".addtolist(\""+b+"\")' style='cursor:pointer;' title='"+(this.foods[b]["nama"])+"' >&#9899; "+
			this.pangkas(this.foods[b]["nama"].replace(/^\(.+\) */,""),35)+"</div>";
		}
		this.listcari.innerHTML=isi==""?"[kosong]":isi;

	};
	//memangkas teks a hanya tinggal sepanjang b ditambah "..."
	this.pangkas=(a,b)=>a.length<b?a:a.slice(0,b-3).replace(/ [^ ]+$/,"")+"...";

	//this.label=a=>"("+a.replace(/^\((.+)\).*$/, "$1").split`-`.map(b=>b[0].toUpperCase()+b.slice(1)).join` `+") "+a.replace(/^\(.+\)/,"");

	//menambah makanan/minuman ke list yang dikonsumsi
	this.addtolist=function(id){

		var a=this.foods[id];
		a.jumlah=100;
		//console.log(a);
		this.listmakan.push(a);
		//console.log(this.listmakan);
		var iid=this.listmakan.length-1;

		var tr = document.createElement("tr");

		//nama
		var td = document.createElement("td");
		sp = document.createElement("a");
		sp1= document.createElement("a");
		sp1.appendChild(document.createTextNode( this.pangkas (this.foods[id]["nama"].replace(/^\(.+\) */,""),25)) );
		sp1.setAttribute("title", this.foods[id]["nama"] );
		//sp1.setAttribute("title", "" );
		sp.appendChild(sp1);
		td.appendChild(sp);
		tr.appendChild(td);


		//porsi
		td = document.createElement("td");
		ip = document.createElement("input");
		ip.setAttribute("type", "number");
		ip.setAttribute("min", "0");
		ip.setAttribute("onchange", this.name+".listmakan["+iid+"].jumlah=this.value ;"+this.name+".hitung2()");
		ip.setAttribute("step", "1");
		ip.setAttribute("max", "1000");
		ip.setAttribute("value", "100");
		ip.setAttribute("size", "3");
		td.appendChild(ip);
		//teks porsi
		sp = document.createElement("a");
		sp1= document.createElement("a");
		sp1.appendChild(document.createTextNode( "% x "+ this.pangkas(this.foods[id]["ukuran"], 16) ) );
		sp.setAttribute("title", this.foods[id]["ukuran"] );
		sp1.setAttribute("title", "" );
		sp.appendChild(sp1);
		td.appendChild(sp);
		tr.appendChild(td);

		//kalori
		td = document.createElement("td");
		td.appendChild(document.createTextNode((this.foods[id]["lemak"]*9 + this.foods[id]["karbohidrat"]*4 + this.foods[id]["protein"]*4)|0) );
		td.innerHTML+="<input type='hidden' value='"+this.foods[id]["karbohidrat"]+"' />";
		td.innerHTML+="<input type='hidden' value='"+this.foods[id]["lemak"]+"' />";
		td.innerHTML+="<input type='hidden' value='"+this.foods[id]["protein"]+"' />";
		tr.appendChild(td);

		//edit
		td = document.createElement("td");
		ip = document.createElement("a");
		ip.setAttribute("style", "cursor:pointer");
		ip.setAttribute("onclick", this.name+".hapus("+iid+") ;this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);"+this.name+".hitung2();");
		ip.appendChild(document.createTextNode("hapus"));
		td.appendChild(ip );
		tr.appendChild(td);

		this.table.appendChild(tr);
		this.table.style.display="";
		this.hitung2();
	};

	this.hitung2=function(){
		var k=0,l=0,p=0, nilai=0;
		for(b of this.listmakan){
			nilai+=(b.karbohidrat*4 + b.lemak*9 + b.protein*4)*b.jumlah/100|0;
			k+=b.karbohidrat*4*b.jumlah/100|0;
			l+=b.lemak*9*b.jumlah/100|0;
			p+=b.protein*4*b.jumlah/100|0;
			
		}
		this.energi.innerHTML=nilai|0;
		this.bar.innerHTML=this.gizi_bar(k,l,p);
	};
	this.hapus=function(id){
		for(var i=id;i<this.listmakan.length-1;i++){
			this.listmakan[i]=this.listmakan[i+1];
		}
		this.listmakan.pop();
	}

	this.hitung=function(){
		var li = this.table.getElementsByTagName('tr');
		var nilai=0;
		var k=0,l=0,p=0;
		for(b of li){
			if(b.getElementsByTagName('td')[2]!==undefined){
				nilai+=b.getElementsByTagName('td')[2].innerHTML.split("<")[0]*b.getElementsByTagName('td')[1].getElementsByTagName("input")[0].value/100|0;
				k+=b.getElementsByTagName('td')[2].getElementsByTagName("input")[0].value*4*b.getElementsByTagName('td')[1].getElementsByTagName("input")[0].value/100|0;
				l+=b.getElementsByTagName('td')[2].getElementsByTagName("input")[1].value*9*b.getElementsByTagName('td')[1].getElementsByTagName("input")[0].value/100|0;
				p+=b.getElementsByTagName('td')[2].getElementsByTagName("input")[2].value*4*b.getElementsByTagName('td')[1].getElementsByTagName("input")[0].value/100|0;
			}
		}
		this.energi.innerHTML=nilai;
		this.bar.innerHTML=this.gizi_bar(k,l,p);
	};


	this.getfoods = function (query,name){
		query=query.toLowerCase();
		for(a in this.buff){
			if(a==query){
				this.foods = this.buff[a];
				__gizi_buruk__(null,name,null);
				return this.foods;
			}
		}
		var request;
		if(window.XMLHttpRequest){
			request=new XMLHttpRequest();
		}else{
			request=new ActiveXObject("Microsoft.XMLHTTP");
		}
				
		
		request.open("GET","gizi.php?fd="+query);
		//request.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
		request.send();
		//this.buff[query]=JSON.parse(request.responseText);
		//this.foods = this.buff[query];
		//return this.foods;
		
		request.onreadystatechange=function(){
			if(request.readyState==4){
				//this.buff[query]=JSON.parse(request.responseText);
				//this.foods = this.buff[query];
				__gizi_buruk__(request.responseText,name,query);

			}
		}

	};


	this.common = function (query){
		query=query.toLowerCase();
		for(a in this.buff){
			if(a==query){
				this.foods = this.buff[a];
				return this.foods;
			}
		}
		var request;
		if(window.XMLHttpRequest){
			request=new XMLHttpRequest();
		}else{
			request=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		request.onreadystatechange=function(){
			if(request.readyState==4){
			}
		}
				
		
		request.open("GET","common2.php",0);
		request.send();
		for(key in (JSON.parse(request.responseText))){
			this.buff[key]=(JSON.parse(request.responseText))[key];
		}


	};


	this.gizi_bar=(a,b,c)=>{
		d=(a+b+c==0)?1:0;
		isi ='<table border="1" style="border-collapse: collapse;margin-top:10px;" width="100%"><tr style="height: 15px;">';
		isi+='<td style="background: #44e;border: 2px #000 solid; width: '+((a)*100/(a+b+c+d*3))+'%;padding: 0px;" ></td>';
		isi+='<td style="width:'+(100-((a)*100/(a+b+c+d*3)))+'%;padding: 0px;"></td>';
		isi+='</tr></table>';
		isi+='<span style="color:#44e">&#9724;</span> '+Math.round(a*100/(a+b+c+d))+'% Karbohidrat<br/>';
		isi+='<table border="1" style="border-collapse: collapse;margin-top:5px;" width="100%"><tr style="height: 15px;">';
		isi+='<td style="background: #4e4;border: 2px #000 solid; width: '+((b)*100/(a+b+c+d*3))+'%;padding: 0px;" ></td>';
		isi+='<td style="width:'+(100-((b)*100/(a+b+c+d*3)))+'%;padding: 0px;"></td>';
		isi+='</tr></table>';
		isi+='<span style="color:#4e4">&#9724;</span> '+Math.round(b*100/(a+b+c+d))+'% Lemak<br/>';
		isi+='<table border="1" style="border-collapse: collapse;margin-top:5px;" width="100%"><tr style="height: 15px;">';
		isi+='<td style="background: #e44;border: 2px #000 solid; width: '+((c)*100/(a+b+c+d*3))+'%;padding: 0px;" ></td>';
		isi+='<td style="width:'+(100-((c)*100/(a+b+c+d*3)))+'%;padding: 0px;"></td>';
		isi+='</tr></table>';
		isi+='<span style="color:#e44">&#9724;</span> '+Math.round(c*100/(a+b+c+d))+'% Protein<br/>';
		return isi;
	};


}

__gizi_buruk__=(r,n,q)=>{
	if(q&&n){
		eval(n+".buff['"+q+"'] = "+r);//this.buff=JSON.parse(request.responseText);
		eval(n+".foods= "+r);
	}
	eval(n+".tampil()");
}