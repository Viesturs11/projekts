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
import java.sql.SQLException;
import java.sql.Timestamp;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

/**
 * Servlet implementation class SaveRecordServlet
 */
public class SaveRecordServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;


	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public SaveRecordServlet() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.sendRedirect("SaveRecord.jsp");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		
		
		
		
		String title = request.getParameter("title");
        String description = request.getParameter("description");
        String date = request.getParameter("date");
        String country = request.getParameter("country");
        
        DateTimeFormatter inputFormatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");
        LocalDate localDate = LocalDate.parse(date, inputFormatter);

        DateTimeFormatter outputFormatter = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");
        String mysqlDateTimeString = localDate.atStartOfDay().format(outputFormatter);
        
		String sql = "INSERT INTO records (title, description, date, country) VALUES (?, ?, ?, ?)";
        //PreparedStatement statement;
        String jdbcURL = "jdbc:mysql://localhost:3306/records";
        String dbUser = "root";
        
        Connection connection1 = null;
        String dbPassword = "";
        
        try {
            // Load the MySQL JDBC driver
            Class.forName("com.mysql.cj.jdbc.Driver");

            // Attempt to establish the connection
            connection1 = DriverManager.getConnection(jdbcURL, dbUser, dbPassword);

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

        //String sql = "INSERT INTO records (title, description, date, country) VALUES (?, ?, ?, ?)";
        
        try (Connection connection = DriverManager.getConnection(jdbcURL, dbUser, dbPassword);
             PreparedStatement statement = connection.prepareStatement(sql)) {
        	
        	Class.forName("com.mysql.cj.jdbc.Driver");
        	
            statement.setString(1, title);
            statement.setString(2, description);
            statement.setString(3, date);
            statement.setString(4, country);

            int rows = statement.executeUpdate();

            if (rows > 0) {
                response.getWriter().println("<h1>Record saved successfully!</h1>");
            } else {
                response.getWriter().println("<h1>Failed to save record.</h1>");
            }

        } catch (SQLException | ClassNotFoundException e) {
            e.printStackTrace();
            response.getWriter().println("<h1>Error: " + e.getMessage() + "</h1>");
        }
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
