package cuitkm;

import java.awt.Desktop;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.List;
import twitter4j.Status;
import twitter4j.TwitterException;
import twitter4j.TwitterFactory;
import twitter4j.conf.ConfigurationBuilder;

public class CuitKM {

    public static void main(String[] args) throws TwitterException, IOException {
        
        ConfigurationBuilder cf = new ConfigurationBuilder();
        
        cf.setDebugEnabled(true)
                .setOAuthConsumerKey("AD3mXRoXybQc5f7GWKCskf791")
                .setOAuthConsumerSecret("YSh43SiKYfydnKDitAy5K8Fx2K1hxnzvxFXwtzY8gMYlzKnhXW")
                .setOAuthAccessToken("94024486-Ih8VhhKumcVAftJoQfKpnY417sR5u11Aw7byjBWh4")
                .setOAuthAccessTokenSecret("uaZqcl09XYk77pFXBLKyiw4px73wjPPylXGWgK1MGKr9I");
        
        TwitterFactory tf = new TwitterFactory(cf.build());
        twitter4j.Twitter twitter = tf.getInstance();
        
        String user="KM_ITB";
        System.out.println("Twitter API: Cuit KM ITB");
        
        List<Status> status = twitter.getUserTimeline(user);
        FileWriter fWriter = null;
        BufferedWriter writer = null;
        fWriter = new FileWriter("index.html");
        writer = new BufferedWriter(fWriter);
        writer.write("<!DOCTYPE html>\n<html>\n");
        writer.write("<head>\n");
        writer.write("<title> Cuit KM ITB </title>\n");
        writer.write("<meta charset=\"utf-8\">\n");
        writer.write("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n");
        writer.write("<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">\n");
        writer.write("<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js\"></script>\n");
        writer.write("<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>\n");
        writer.write("</head>\n");
        writer.write("<body class=\"container\">\n");
        writer.write("<div class = \"jumbotron text-center\">");
	writer.write("<h1> Tweet oleh KM ITB </h1>");
	writer.write("<p> Halaman ini menampilkan berbagai tweet yang dirilis oleh Keluarga Mahasiswa Institut Teknologi Bandung melalui akun Twitter @KM_ITB.</p>");
	writer.write("</div>");
        writer.write("<div class=\"text-center\">\n");
        for (Status st : status)
        {
            writer.write("<span>");
            System.out.println(st.getUser().getName()+": "+st.getText());
            writer.write("<blockquote class=\"twitter-tweet tw-align-center\" data-lang=\"en\"><a href=\"https://twitter.com/" + st.getUser().getScreenName() + "/status/" + st.getId() + "\"></a></blockquote>\n");
            writer.write("<script async src=\"http://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>\n");
            writer.write("</span>\n<br>");

        }
        writer.write("</div>\n");
        writer.write("</body>\n");
        writer.write("</html>\n");
        writer.close();
        fWriter.close();
        File htmlFile = new File("index.html");
        Desktop.getDesktop().browse(htmlFile.toURI());
    }
    
}
