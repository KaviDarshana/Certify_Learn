<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
        exit;
    } else {
        header("Location: home.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Learning Management System</title>
    <link rel="stylesheet" href="css/about-us.css">
    <link rel="stylesheet" href="css/Contact-us.css">
    <link rel="stylesheet" href="css/certificate_preview.css">
    <link rel="stylesheet" href="css/hero.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/reviews.css">
    <link rel="stylesheet" href="css/devoloper-section.css">
    <link rel="stylesheet" href="css/footer.css">



    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: #333;
            line-height: 1.6;
        }

    </style>
</head>
<body>


   <header>
        <nav class="navbar">
            <div class="logo">Certify <span class="logo2">Learn</span></div>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#about">About Us</a>
                <a href="#testimonials">Student Review</a>
                <a href="#contact">Contact</a>
            </div>
            <div class="auth-buttons">
                <a href="login.php" class="login-btn">Login</a>
                <a href="register.php" class="signup-btn">Sign Up</a>
            </div>
        </nav>
    </header>






    <section class="hero" id="home">
        <div class="border">
        <h2>Hello Student! <span id="greeting" style="color: yellow;"></span></h2>
        <h2>Have a great Day</h2>
        <h1>Welcome To Our Online Learning Platform</h1>
        <h2>Enhance your <span class="changeword"></span></h2>
        <p>Enhance your skills with our wide range of courses, designed to help
             you grow professionally and personally. Whether you're looking to
              upskill in the latest technologies, improve your business acumen,
               or pursue a new hobby, we have something for everyone.</p>
        <div class="hero-buttons">
            <a href="register.php" class="hero-btn primary">Get Started</a>
            <a href="#our-story" class="hero-btn secondary">Learn More</a>
        </div>
        </div>
    </section>

<div id="about-popup" class="about-popup">
    <span class="about-close" id="close-about-popup">&times;</span>
    <div class="about-popup-content">
        <h2>About Our Programming Courses</h2>
        <p>✅ At Certiify learn, we offer a variety of programming courses designed to help students of all skill levels succeed in the world of coding. Whether you're a beginner or an experienced developer, our courses will equip you with the skills needed to excel in the tech industry.</p><br>        
        <p>✅ Our courses are taught by experienced instructors who are passionate about teaching. We focus on hands-on learning, ensuring that students gain real-world experience through coding projects and challenges.</p><br>       
        <p>✅ We offer courses in multiple programming languages, including Python, Java, JavaScript, C++, and more. Students will have the opportunity to learn fundamental concepts like algorithms, data structures, and object-oriented programming, as well as explore advanced topics such as web development, machine learning, and game development.</p><br>        
        <p>✅ Our flexible learning options include online courses, live webinars, and in-person classes, making it easy for anyone to learn at their own pace, from anywhere in the world.</p><br>        
        <p>✅ Join our community of learners and become a part of the future of tech!</p>
    </div>
</div>








    <section id="our-story">
        <div class="content-wrapper">
            <div class="story-content">
                <div class="image-wrapper">
                    <img src="Images/about-us-edu-img.jpg" alt="About Us Image">
                </div>
    
                <div class="details-wrapper">
                    <h3>Why Choose Us?</h3>
                    <p>We offer personalized learning experiences to help you achieve your goals, no matter where you are on your journey.</p>
    
                    <ul>
                        <li><strong>Expert Educators:</strong> Learn from top professionals with real-world experience.</li>
                        <li><strong>Self-paced Learning:</strong> Study at your own pace with flexible schedules.</li>
                        <li><strong>Remote learning:</strong> You can remote learn.</li>
                        <li><strong>Easy Learning:</strong> You can easy learn online.</li>

                    </ul>
                </div>
            </div>
    
            <div class="inspiration-quote">
                <blockquote>
                    "Education is the key to unlocking the world, a passport to freedom." - Oprah Winfrey 🎓💡
                </blockquote>
                <br>
                <blockquote>
                "The beautiful thing about learning is that no one can take it away from you." – B.B. King 🎓💡
                </blockquote>
            </div>
    
            <div class="action-button">
                <button class="learn-more" id="learn-more-btn-about">Explore More</button>
            </div>
        </div>
    </section>






    <section id="certificate" class="certificate">
        <h2>Earn Certificate</h2>
        <p>Earn certificates to showcase your learning achievements. Certificates are issued upon completion of courses and can be downloaded for personal use or shared on professional platforms.</p>
        
        <div class="certificate-details">
            <h3>Certificate Details</h3>
            <p>This certificate validates the completion of the course with distinction. It serves as a testament to your dedication, skill acquisition, and commitment to learning. Share it with pride!</p>
        </div>
        
        <img src="Images/certificate.png" alt="Certificate Preview" />
        
        <div class="testimonials">
            <h3>What Our Learners Say</h3>
            <p>"This course helped me advance my career. The certificate gave me credibility in my industry!" – Thilini Jayawikrama</p>
            <p>"I'm proud of the certificate I earned. It gave me the confidence to pursue further education." – Naween Madumal</p>
        </div>
    
        <div class="faq">
            <h3>Frequently Asked Questions</h3>
            <dl>
                <dt>How do I receive my certificate?</dt>
                <dd>After completing the Exam, You can download your certificate.</dd>
            </dl>
        </div>
    </section>
    
    







    <section id="developer" class="developer">
        <h2>Developers</h2>
        <p>Meet the team behind this platform.</p>
        <div class="team">
            <div class="team-member">
                <img src="Images/imesh.jpg" alt="Imesh Kavinda">
                <h3>Imesh Kavinda</h3>
                <p>University of Moratuwa</p>
                <p><b>Student</b></p>
                <p class="bio">Bachelor of information Technology</p>
                <a href="https://www.linkedin.com/in/imeshkavinda" target="_blank" class="linkedin">LinkedIn</a>
            </div>
            <div class="team-member">
                <img src="Images/ashan.png" alt="Ashan Shanaka">
                <h3>Ashan Shanaka</h3>
                <p>University of Moratuwa</p>
                <p><b>Student</b></p>
                <p class="bio">Bachelor of information Technology</p>
                <a href="https://www.linkedin.com/in/ashanshanaka" target="_blank" class="linkedin">LinkedIn</a>
            </div>
            <div class="team-member">
                <img src="Images/kavindu.jpg" alt="Kavindu Herath">
                <h3>Kavindu Herath</h3>
                <p>University of Moratuwa</p>
                <p><b>Student</b></p>
                <p class="bio">Bachelor of information Technology</p>
                <a href="https://www.linkedin.com/in/kavindusherath" target="_blank" class="linkedin">LinkedIn</a>
            </div>
        </div>
    </section>






    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

     <section class="contact" id="contact">
        <h2 class="section-title">Contact Us</h2>
        <div class="contact-container">
            <div class="contact-form">
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn" id="submitButton">
                        Send Message
                        <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
                    </button>
                    <div id="formStatus" class="form-status"></div>
                </form>
            </div>
        </div>
    </section>

    <script>
        (function() {
            emailjs.init("5EO1ISQdd1D5Vyu4C");
        })();

        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contactForm');
            const submitButton = document.getElementById('submitButton');
            const formStatus = document.getElementById('formStatus');
            const loadingSpinner = document.getElementById('loadingSpinner');

            contactForm.addEventListener('submit', function(event) {
                event.preventDefault();
                
                submitButton.disabled = true;
                loadingSpinner.style.display = 'inline-block';
                
                const formData = {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    subject: document.getElementById('subject').value,
                    message: document.getElementById('message').value
                };
                
                emailjs.send('service_iarotjj', 'template_8bvhsp1', formData)
                    .then(function(response) {
                        formStatus.innerHTML = '<div class="alert alert-success">Thank you! Your message has been sent successfully.</div>';
                        formStatus.style.display = 'block';
                        
                        contactForm.reset();
                        
                        setTimeout(function() {
                            formStatus.style.display = 'none';
                        }, 5000);
                    })
                    .catch(function(error) {
                        formStatus.innerHTML = '<div class="alert alert-error">Oops! Something went wrong. Please try again later.</div>';
                        formStatus.style.display = 'block';
                        console.error('EmailJS error:', error);
                    })
                    .finally(function() {
                        submitButton.disabled = false;
                        loadingSpinner.style.display = 'none';
                    });
            });
        });
    </script>







<section class="testimonials" id="testimonials">
    <h2 class="section-title">What Our Students Say</h2>
    <div class="testimonial-container">
        <?php
        include 'db.php';
        $testimonials = $conn->query("SELECT * FROM reviews WHERE status = 'approved' ORDER BY RAND() LIMIT 4");
        
        if ($testimonials->num_rows > 0) {
            while ($testimonial = $testimonials->fetch_assoc()) {
        ?>
            <div class="testimonial-card">
                <div class="rating">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $testimonial['rating'] ? "★" : "☆";
                    }
                    ?>
                </div>
                <p class="testimonial-text">"<?php echo htmlspecialchars($testimonial['review_text']); ?>"</p>
                <div class="student-info">
                    <p class="student-name"><?php echo htmlspecialchars($testimonial['student_name']); ?></p>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<p class='no-testimonials'>No testimonials available yet.</p>";
        }
        ?>
    </div>
</section>









    <footer>
        <div class="footer-content">
            <div class="footer-logo">Certify <span class="footer-logo2">Learn</span></div>
            <div class="footer-links">
                <a href="#home">Home</a>
                <a href="#about">About Us</a>
                <a href="#contact">Contact</a>
                <a href="login.php">Login</a>
                <a href="register.php">Sign Up</a>
            </div>
            <div class="copyright">
                &copy; 2025 Certify Learn. All rights reserved.
            </div>
        </div>
    </footer>



    <script src="JS/course-preview.js"></script>
    <script src="JS/aboutus.js"></script>
    <script src="js/homepage.js"></script>
</body>
</html>