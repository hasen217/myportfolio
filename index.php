<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hasen Bashree Portfolio</title>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <!-- ================= NAVIGATION ================= -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="#home">Hasen <span>Bashree</span></a>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#education" class="nav-link">Education</a></li>
                <li><a href="#achievement" class="nav-link">Achievements</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
            <div class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- ================= HERO ================= -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Hasen Bashree</h1>
            <p>BCA Student | Web Developer | Full Stack Developer</p>
            <a href="#contact" class="btn">Let's Connect</a>
        </div>
    </section>

    <!-- ================= ABOUT ================= -->
    <section class="about" id="about">
        <div class="section-title">
            <h2>About Me</h2>
            <span>Who I Am</span>
        </div>
        <div class="about-container">
            <div class="about-image">
                <img src="HASENPHOT.jpeg" alt="Hasen Bashree" />
            </div>
            <div class="about-content">
                <h3>Hello! I'm Hasen Bashree</h3>
                <h4>BCA Student | Web Developer | Full Stack Developer</h4>
                <p>
                    I am a passionate BCA student from Ballari, Karnataka.
                    I love creating modern, responsive and user-friendly websites using HTML, CSS,
                    JavaScript, PHP and MySQL. I enjoy solving real-world problems through
                    programming and continuously learning new technologies.
                </p>
                <div class="about-info">
                    <div><span>Name</span><p>Hasen Bashree</p></div>
                    <div><span>Email</span><p>hasenbashree@gmail.com</p></div>
                    <div><span>Phone</span><p>+91 8088275778</p></div>
                    <div><span>City</span><p>Ballari, Karnataka</p></div>
                    <div><span>Degree</span><p>Bachelor of Computer Applications</p></div>
                    <div><span>Languages</span><p>English, Kannada, Hindi, Urdu, Arabic</p></div>
                </div>
                <a href="HASEN_BASHREE_Resume.pdf" class="btn" download>Download Resume</a>
            </div>
        </div>
    </section>

    <!-- ================= PROJECTS ================= -->
    <section class="projects" id="projects">
        <div class="section-title">
            <h2>My Projects</h2>
            <span>Latest Work</span>
        </div>
        <div class="project-container">
            <div class="project-card">
                <img src="assets/real-estate.jpg" alt="Project" />
                <div class="project-content">
                    <h3>Real Estate Management System</h3>
                    <p>
                        A complete web application developed using HTML, CSS, JavaScript, PHP and MySQL.
                        Users can buy, sell and rent properties with secure login and property management.
                    </p>
                    <div class="tech">
                        <span>HTML</span><span>CSS</span><span>JavaScript</span><span>PHP</span><span>MySQL</span>
                    </div>
                    <div class="project-buttons">
                        <a href="#" class="btn">Live Demo</a>
                        <a href="https://github.com/hasen217" target="_blank" class="btn btn2">GitHub</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= EDUCATION ================= -->
    <section class="education" id="education">
        <div class="section-title">
            <h2>Education</h2>
            <span>Academic Journey</span>
        </div>
        <div class="timeline">
            <div class="timeline-item">
                <h3>Bachelor of Computer Applications (BCA)</h3>
                <p>Saraladevi Satishchandra Agarwal College, Ballari</p>
                <span>2023 - Present</span>
            </div>
            <div class="timeline-item">
                <h3>PUC</h3>
                <p>Karnataka Board</p>
                <span>2023</span>
            </div>
            <div class="timeline-item">
                <h3>SSLC</h3>
                <p>Karnataka Board</p>
                <span>2021</span>
            </div>
        </div>
    </section>

    <!-- ================= ACHIEVEMENTS ================= -->
    <section class="achievement" id="achievement">
        <div class="section-title">
            <h2>Achievements</h2>
            <span>Highlights</span>
        </div>
        <div class="achievement-container">
            <div class="achievement-card">
                <i class="fas fa-award"></i>
                <h3>Scholarship</h3>
                <p>Received Scholarship during BCA.</p>
            </div>
            <div class="achievement-card">
                <i class="fas fa-laptop-code"></i>
                <h3>Coding Competition</h3>
                <p>Participated in Coding Competitions.</p>
            </div>
            <div class="achievement-card">
                <i class="fas fa-file-powerpoint"></i>
                <h3>Paper Presentation</h3>
                <p>Presented Technical Seminar Successfully.</p>
            </div>
        </div>
    </section>

    <!-- ================= CONTACT (SINGLE - CLEAN) ================= -->
    <section class="contact" id="contact">
        <div class="section-title">
            <h2>Contact Me</h2>
            <span>Let's Work Together</span>
        </div>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Get In Touch</h3>
                <p>
                    Feel free to contact me for Web Development, Projects, Freelancing and Internship opportunities.
                </p>
                <div class="info-box">
                    <i class="fas fa-envelope"></i>
                    <span>hasenbashree@gmail.com</span>
                </div>
                <div class="info-box">
                    <i class="fas fa-phone"></i>
                    <span>+91 8088275778</span>
                </div>
                <div class="info-box">
                    <i class="fas fa-location-dot"></i>
                    <span>Ballari, Karnataka, India</span>
                </div>
                <div class="social">
                    <a href="https://github.com/hasen217" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="mailto:hasenbashree@gmail.com"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            
            <!-- ✅ SINGLE FORM WITH PHP ACTION -->
            <!-- Update the form action in your HTML -->
<form action="contact.php" method="POST">
    <input type="text" name="name" placeholder="Your Name" required />
    <input type="email" name="email" placeholder="Email Address" required />
    <input type="text" name="subject" placeholder="Subject" />
    <textarea name="message" rows="7" placeholder="Write your message" required></textarea>
    <button type="submit" class="btn">Send Message</button>
</form>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer>
        <h2>Hasen Bashree</h2>
        <p>BCA Student | Web Developer | Full Stack Developer</p>
        <div class="footer-social">
            <a href="https://github.com/hasen217" target="_blank"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
        <p class="copyright">© 2026 Hasen Bashree. All Rights Reserved.</p>
    </footer>

    <!-- ================= NAV SCRIPT ================= -->
    <script>
        const toggle = document.getElementById('navToggle');
        const menu = document.getElementById('navMenu');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });

        // Close menu on link click (mobile)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.remove('active');
            });
        });
    </script>

</body>
</html>