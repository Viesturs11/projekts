package HelloWorld;

public class Record {
    private int id;
    private String title;
    private String description;
    private String date;
    private String country;

    // Constructors
    public Record() {
    }

    public Record(int id, String title, String description, String date, String country) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.date = date;
        this.country = country;
    }

    // Getters and Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getCountry() {
        return country;
    }

    public void setCountry(String country) {
        this.country = country;
    }
}
