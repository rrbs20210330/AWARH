import java.util.*;
public class menu {
    /*No tocar
    Este menu lo andaba haciendo de mame */
    public static void main(String [] args){
        Scanner sc = new Scanner(System.in);
        int op;
        boolean bandera = true;
        boolean login;
        System.out.println("Clases programadas con funcionamiento");
        while (bandera){
            System.out.println("Ingresa un numero para seleccionar una opcion:efeefe");
            op = sc.nextInt();

            switch(op){
                case 1:
                    User us = new User(1,"username", "password",true);
                    login = us.Login(sc.nextInt(), sc.next());
                    if(login){
                        while (bandera) {
                            System.out.println("Menu principal\nIngresa un numero para seleccionar una accion");
                            System.out.println("\n1.Citar Candidato\n2.Crear Formulario\n3.Crear convocatoria\n4.Ir a Capacitaciones\n5.Ir a Contratacion\n6.Salir");
                            int opMenu = sc.nextInt();
                            switch (opMenu) {
                                case 1:
                                    System.out.println("citar");
                                    break;
                                case 2: 
                                    System.out.println("formulario");
                                    break;
                                case 3:
                                    System.out.println("convocatoria");
                                    break;
                                case 4: 
                                    System.out.println("capacitaciones");
                                    break;
                                case 5: 
                                    System.out.println("contrataciones");
                                    break;
                                case 6:
                                    bandera = false;
                                    break;
                                default:
                                    System.out.println("opcion no valida");
                                    break;
                            }
                        }
                        
                    }else{
                        System.out.println("Incorrecto, vuelve a intentarlo");
                        bandera = false;
                    }
                    break;
                case 2:
                    bandera = false;
                    break;
            }
        }
        

    }
    

    
}
