package ass;

import java.sql.Blob;
import java.sql.Connection;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

public class demo {
	String url="jdbc:mysql://localhost:3306/test";
	 String username="root";
	 String pwd="";
	 private String ename;
	private Date dob;
	 private Blob image;
	 private int eid;
	 
	 
	 public String getEname(){
	 
	return ename;  
	
		}

	public int getStore() {
		try{  
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection(  
					url,username,pwd); 
			PreparedStatement ps=con.prepareStatement("select * from employee");
			ps.setInt(1, 2);
			ResultSet rs=ps.executeQuery();  
			while(rs.next()) {
				if(rs.getInt(1)==eid) {
				this.ename= rs.getString(2);
				this.dob=rs.getDate(4);
				this.image=rs.getBlob(3);}
				
				
			}
			
		}catch(Exception e){ e.printStackTrace();
		e.printStackTrace();
		 this.ename="sri";
		
		}
		
		return 12;
	}

	public void seteid(int eid) {
		this.eid = eid;
	}

	public Date getDob() {
		return dob;
	}

	public void setDob(Date dob) {
		this.dob = dob;
	}

	public Blob getImage() {
		return image;
	}

	public void setImage(Blob image) {
		this.image = image;
	}
	
}

