package com.nupuvere; /**
 * Created by Martin on 18.09.2016.
 */
import static spark.Spark.*;

public class App {
    public static void main(String[] args) {
        get("/hello", (req, res) -> "Hello World!!!!!!!!!!!!");
    }
}
