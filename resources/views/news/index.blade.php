<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maliks News | Breaking & Latest Updates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #121212;
            color: white;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Header */
        .header {
            background: #d50000;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        /* Breaking News Ticker */
        .breaking-news {
            background: #ff3d00;
            color: white;
            padding: 10px;
            font-weight: bold;
            overflow: hidden;
            white-space: nowrap;
        }

        .breaking-news marquee {
            font-size: 16px;
        }

        /* Hero Section with Video */
        .hero-section {
            position: relative;
            width: 100%;
            height: 600px;
            background: black;
        }

        .hero-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .hero-overlay h1 {
            font-size: 40px;
            margin-bottom: 10px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero-overlay p {
            font-size: 20px;
            margin-bottom: 20px;
            animation: fadeIn 2s ease-in-out;
        }

        /* News Sections */
        .news-container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        /* Live News Auto Scroll */
        .live-news {
            background: #222;
            padding: 10px;
            margin-top: 20px;
            overflow: hidden;
            white-space: nowrap;
        }

        .live-news span {
            color: yellow;
            font-weight: bold;
        }

        /* News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .news-card {
            background: #1e1e1e;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .news-card:hover {
            transform: scale(1.05);
        }

        .news-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .news-content {
            padding: 10px;
        }

        /* Side Section */
        .side-section {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .category {
            flex: 1;
            margin-right: 20px;
        }

        .category h2 {
            background: #ff3d00;
            padding: 10px;
            margin-bottom: 10px;
        }

        .category ul {
            list-style: none;
        }

        .category li {
            padding: 10px;
            border-bottom: 1px solid #333;
            transition: background 0.3s ease;
        }

        .category li:hover {
            background: #333;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 15px;
            background: #222;
            margin-top: 50px;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Sidebar */
        .sidebar {
            background: #1e1e1e;
            padding: 20px;
            margin-top: 30px;
            max-width: 100%;
            border-radius: 8px;
            display: flex;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
            justify-content: center;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .widget {
            margin-bottom: 20px;
        }

        .widget h2 {
            font-size: 20px;
            margin-bottom: 10px;
            border-bottom: 2px solid #ff3d00;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">Al Nashra by Maliks</div>

    <!-- Breaking News Ticker -->
    <div class="breaking-news">
        <marquee>
            <span>🔥 Shadi Farhat has being promoted to the It Department</span>
            <span>🚀 Congrats for Loulwa for being promoted to Supervisor</span>
            <span>💰 Ali Yassin turned 43 years, Happy Birthday Alloush</span>
        </marquee>
    </div>

    <!-- Hero Section with Video -->
    <div class="hero-section">
        <video autoplay loop controls class="hero-video">
            <source src="storage/videos/Malik's Show - Episode 9.mp4" type="video/mp4">
        </video>

    </div>

    <!-- Live News Scrolling -->
    <div class="live-news">
        <marquee behavior="scroll" direction="left">
            <span>🔴 LIVE: </span> Malik's Show - Episode 9
        </marquee>
    </div>

    <!-- News Sections -->
    <!-- Latest News -->
    <div class="news-container">
        <h2>📰 Latest News</h2>
        <div class="news-grid">
            <div class="news-card">
                <img src="https://plus.unsplash.com/premium_photo-1677529496297-fd0174d65941?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Stock Market Hits Record High</h3>
                    <p>The global stock market has reached new highs...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1664574654700-75f1c1fad74e?q=80&w=2574&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>New AI Model Smashes Records</h3>
                    <p>Artificial Intelligence is taking over...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://plus.unsplash.com/premium_photo-1677529496297-fd0174d65941?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Stock Market Hits Record High</h3>
                    <p>The global stock market has reached new highs...</p>
                </div>
            </div>

        </div>
    </div>

    <!-- World News -->
    <div class="news-container world-news">
        <h2>🌍 World News</h2>
        <div class="news-grid">
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1510146758428-e5e4b17b8b6a?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>UN Calls for Peace Amid Rising Tensions</h3>
                    <p>Diplomatic efforts are underway to prevent conflict...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Global Elections: What's at Stake?</h3>
                    <p>Upcoming elections in major nations could shift the balance of power...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://plus.unsplash.com/premium_photo-1677529496297-fd0174d65941?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Stock Market Hits Record High</h3>
                    <p>The global stock market has reached new highs...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Business & Finance -->
    <div class="news-container">
        <h2>💰 Business & Finance</h2>
        <div class="news-grid">
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1566140967404-b8b3932483f5?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Crypto Market Sees Biggest Drop in Years</h3>
                    <p>Bitcoin and other cryptocurrencies have taken a major hit...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1506869640319-fe1a24fd76dc?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>How to Invest in 2025: Experts Share Insights</h3>
                    <p>Financial analysts provide key strategies for the new economy...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://plus.unsplash.com/premium_photo-1677529496297-fd0174d65941?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Stock Market Hits Record High</h3>
                    <p>The global stock market has reached new highs...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tech & Science -->
    <div class="news-container tech-science">
        <h2>🔬 Tech & Science</h2>
        <div class="news-grid">
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1526663089957-f2aa2776f572?q=80&w=2671&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>NASA Confirms New Habitable Exoplanet</h3>
                    <p>Astronomers have discovered a planet that could support life...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>AI Breakthrough: Machines Now Smarter Than Humans?</h3>
                    <p>New algorithms are pushing the boundaries of artificial intelligence...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://plus.unsplash.com/premium_photo-1677529496297-fd0174d65941?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Stock Market Hits Record High</h3>
                    <p>The global stock market has reached new highs...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sports -->
    <div class="news-container sports-news">
        <h2>⚽ Sports Highlights</h2>
        <div class="news-grid">
            <div class="news-card">
                <img src="https://media.istockphoto.com/id/1502846052/photo/textured-soccer-game-field-with-neon-fog-center-midfield.jpg?s=2048x2048&w=is&k=20&c=Es-Z04yyJnxeWuxAOVjmeL0MHvcPr_TlqJmOr9edY0E="
                    alt="News">
                <div class="news-content">
                    <h3>Champions League: Who Will Take the Trophy?</h3>
                    <p>The world's biggest clubs face off for football supremacy...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://media.istockphoto.com/id/484868394/photo/soccer-players-in-action.jpg?s=2048x2048&w=is&k=20&c=tWyHOct21UBLaawXnSbpYnOYFCIyOpaujqy9Xm7RXxY="
                    alt="News">
                <div class="news-content">
                    <h3>NBA Finals: The Matchup Everyone Wants</h3>
                    <p>Basketball's biggest rivalry is back on the court...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://plus.unsplash.com/premium_photo-1677529496297-fd0174d65941?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Stock Market Hits Record High</h3>
                    <p>The global stock market has reached new highs...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Entertainment & Culture -->
    <div class="news-container entertainment">
        <h2>🎭 Entertainment & Culture</h2>
        <div class="news-grid">
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1520333789090-1afc82db536a?q=80&w=2671&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Biggest Blockbusters Coming in 2025</h3>
                    <p>Hollywood is gearing up for its biggest movie year yet...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1520333789090-1afc82db536a?q=80&w=2671&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>The Rise of AI-Generated Music</h3>
                    <p>Technology is reshaping the way we create and listen to music...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Opinion & Editorial -->
    <div class="news-container">
        <h2>🗞️ Opinion & Editorials</h2>
        <div class="news-grid">
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1520333789090-1afc82db536a?q=80&w=2671&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Why the Economy is More Fragile Than You Think</h3>
                    <p>An expert economist shares insights on global financial instability...</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1520333789090-1afc82db536a?q=80&w=2671&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="News">
                <div class="news-content">
                    <h3>Should Social Media Be Regulated?</h3>
                    <p>Experts debate whether governments should step in...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="widget">
            <h2>🌤️ Weather Update</h2>
            <p>New York: 15°C, Sunny</p>
            <p>London: 10°C, Cloudy</p>
        </div>
        <div class="widget">
            <h2>📈 Market Summary</h2>
            <p>Dow Jones: +0.5%</p>
            <p>NASDAQ: -1.2%</p>
        </div>
    </div>


    <!-- Footer -->
    <div class="footer">
        &copy; 2025 Maliks News. All Rights Reserved.
    </div>

</body>

</html>
