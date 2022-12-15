public class Contract {
    private int id;
    private int document;


    public Contract(){
        this.id = 0;
        this.document = 0;
    }
    public Contract(int i_id, int i_Document){
        this.id = i_id;
        this.document = i_Document;
    }

    public void setDocument(int newDocument){
        this.document = newDocument;
    }
    
    public int getId(){
        return id;
    }
    
    public int getDocument(){
        return document;
    }

   
}
