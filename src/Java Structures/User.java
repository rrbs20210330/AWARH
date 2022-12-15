public class User {
    private boolean isAdmin;
    private int idUser;
    private String username;
    private String passw;

    public User(){
        this.isAdmin = false;
        this.idUser = 0;
        this.passw = "";
        this.username = "";
    }

    public User(int idUser, String username, String password, boolean isAdmin){
        this.isAdmin = isAdmin;
        this.idUser = idUser;
        this.passw = password;
        this.username = username;
    }

    public void setPassword(String PASSWORD){
        this.passw = PASSWORD;
    }

    public void setIsAdmin(boolean Admin){
        this.isAdmin = Admin;
    }

    public void setIdUser(int IDUSER){
        this.idUser = IDUSER;
    }

    public void setUsername(String newUsername){
        this.username = newUsername;
    }

    public int getIdUser(){
        return idUser;
    }
    public boolean getIsAdmin(){
        return isAdmin;
    }
    public String getUsername(){
        return username;
    }

    public boolean Login(int IDUSER, String PASSWORD){
        if(IDUSER == this.idUser){
            if(PASSWORD.equals(this.passw)){

                return true;
            }else return false;
            
        }else return false; 
    }
    
    

}
