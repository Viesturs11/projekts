package HelloWorld;

import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

/**
 * Servlet implementation class ViewRecordsServlet
 */
public class ViewRecordsServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ViewRecordsServlet() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		List<Record> records = new ArrayList<>();
        Connection connection = null;
        PreparedStatement statement = null;
        ResultSet resultSet = null;
        
        Connection connection1 = null;
        String dbPassword1 = "";
        String jdbcURL1 = "jdbc:mysql://localhost:3306/records";
        String dbUser1 = "root";
        
        try {
            // Load the MySQL JDBC driver
            Class.forName("com.mysql.cj.jdbc.Driver");

            // Attempt to establish the connection
            connection1 = DriverManager.getConnection(jdbcURL1, dbUser1, dbPassword1);

            // Check if the connection is successful
            if (connection1 != null) {
                System.out.println("Connection to database established successfully.");
                // Perform your database operations here
            } else {
                System.out.println("Failed to make connection!");
            }

        } catch (ClassNotFoundException e) {
            e.printStackTrace();
            System.out.println("MySQL JDBC driver not found.");
        } catch (SQLException e) {
            e.printStackTrace();
            System.out.println("Connection failed. Check output console.");
        } finally {
            try {
                if (connection1 != null) {
                    connection1.close();
                    System.out.println("Connection closed successfully.");
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }

        try {
            // Establish database connection (replace with your database details)
            String jdbcURL = "jdbc:mysql://localhost:3306/records";
            String dbUser = "root";
            String dbPassword = "";
            connection = DriverManager.getConnection(jdbcURL, dbUser, dbPassword);

            // Query to fetch records from database
            String sql = "SELECT * FROM records";
            statement = connection.prepareStatement(sql);
            resultSet = statement.executeQuery();

            // Process ResultSet and populate records list
            while (resultSet.next()) {
                int id = resultSet.getInt("id");
                String title = resultSet.getString("title");
                String description = resultSet.getString("description");
                String date = resultSet.getString("date");
                String country = resultSet.getString("country");

                Record record = new Record(id, title, description, date, country);
                records.add(record);
            }

            // Set records as a request attribute
            request.setAttribute("records", records);

            // Forward the request to the JSP for rendering
            request.getRequestDispatcher("ViewRecords.jsp").forward(request, response);

        } catch (SQLException e) {
            e.printStackTrace();
        } finally {
            // Close resources
            try {
                if (resultSet != null) resultSet.close();
                if (statement != null) statement.close();
                if (connection != null) connection.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
