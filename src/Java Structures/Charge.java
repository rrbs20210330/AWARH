public class Charge {
    private int id;
    private String name;
    private String area;

    public Charge(){
        this.id = 0;
        this.name = "";
        this.area = "";
    }
    public Charge(int i_id, String i_name, String i_area){
        this.id = i_id;
        this.name = i_name;
        this.area = i_area;
    }


    public void setName(String newName){
        this.name = newName;
    }

    public void setArea(String newArea){
        this.area = newArea;
    }
    public String getName(){
        return name;
    }
    public String getArea(){
        return area;
    }
    public int getId(){
        return id;
    }

}