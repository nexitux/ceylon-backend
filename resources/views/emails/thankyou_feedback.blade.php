<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Thank You – Ceylon Bake House</title>
		<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500&display=swap" rel="stylesheet">
		<style>
			* { box-sizing: border-box; margin: 0; padding: 0; }
			body {
			background: #f0e8db;
			font-family: 'Geist', sans-serif;
			color: #1a1208;
			-webkit-font-smoothing: antialiased;
			}
			.wrap {
			max-width: 560px;
			margin: 0 auto;
			background: #f0e8db;
			}
			/* HEADER */
			.header {
			background: #fff;
			padding: 40px 36px 32px;
			text-align: center;
			border-bottom: 1px solid #ede4d8;
			}
			.logo {
			width: 56px; height: 56px;
			background: #7a331d;
			border-radius: 14px;
			display: inline-flex;
			align-items: center; justify-content: center;
			margin-bottom: 16px;
			}
			.logo svg { width: 30px; height: 30px; }
			.brand {
			font-family: 'Instrument Serif', serif;
			font-size: 22px;
			color: #7a331d;
			font-weight: 400;
			display: block;
			margin-bottom: 4px;
			}
			.tagline {
			font-size: 11px;
			color: #b09070;
			letter-spacing: 1.8px;
			text-transform: uppercase;
			font-weight: 300;
			}
			/* HERO */
			.hero {
			background: #7a331d;
			padding: 44px 36px;
			text-align: center;
			}
			.thank-icon {
			width: 64px; height: 64px;
			background: rgba(255,228,192,0.15);
			border: 1.5px solid rgba(255,228,192,0.25);
			border-radius: 50%;
			display: inline-flex;
			align-items: center; justify-content: center;
			margin-bottom: 20px;
			}
			.thank-icon svg { width: 28px; height: 28px; }
			.hero h1 {
			font-family: 'Instrument Serif', serif;
			font-size: 30px;
			color: #ffe4c0;
			font-weight: 400;
			line-height: 1.25;
			margin-bottom: 12px;
			}
			.hero p {
			font-size: 14px;
			color: rgba(255,228,192,0.65);
			line-height: 1.7;
			font-weight: 300;
			max-width: 380px;
			margin: 0 auto;
			}
			/* BODY */
			.body { padding: 24px 20px; }
			/* SUMMARY CARD */
			.card {
			background: #fff;
			border-radius: 14px;
			border: 1px solid #ede4d8;
			overflow: hidden;
			margin-bottom: 12px;
			}
			.summary-row {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 13px 20px;
			border-bottom: 1px solid #f5ede4;
			gap: 12px;
			}
			.summary-row:last-child { border-bottom: none; }
			.s-label {
			font-size: 13px;
			color: #8a6040;
			font-weight: 300;
			}
			.s-val {
			font-size: 13px;
			color: #1a1208;
			font-weight: 500;
			text-align: right;
			}
			.s-val.brown { color: #7a331d; }
			/* SCORE ROW */
			.score-row {
			padding: 20px;
			display: flex;
			align-items: center;
			gap: 16px;
			border-bottom: 1px solid #f5ede4;
			}
			.score-num {
			font-family: 'Instrument Serif', serif;
			font-size: 36px;
			color: #7a331d;
			line-height: 1;
			flex-shrink: 0;
			}
			.score-sub {
			font-size: 11px;
			color: #b09070;
			margin-top: 2px;
			}
			.score-divider {
			width: 1px; height: 32px;
			background: #ede4d8;
			flex-shrink: 0;
			}
			.stars-wrap { flex: 1; }
			.stars {
			display: flex;
			gap: 3px;
			margin-bottom: 5px;
			}
			.stars svg { width: 14px; height: 14px; }
			.score-note {
			font-size: 12px;
			color: #9a8060;
			font-weight: 300;
			}
			/* MESSAGE BOX */
			.msg-box {
			padding: 20px;
			}
			.msg-box p {
			font-family: 'Instrument Serif', serif;
			font-size: 15px;
			color: #3a2010;
			line-height: 1.75;
			font-style: italic;
			}
			.msg-sig {
			margin-top: 14px;
			font-size: 12.5px;
			color: #8a6040;
			font-weight: 300;
			}
			.msg-sig strong {
			display: block;
			font-size: 13.5px;
			font-weight: 500;
			color: #7a331d;
			margin-bottom: 1px;
			}
			/* DIVIDER */
			.or-divider {
			text-align: center;
			font-size: 11px;
			color: #b09070;
			letter-spacing: 1px;
			text-transform: uppercase;
			margin: 4px 0;
			position: relative;
			}
			/* VISIT AGAIN */
			.visit-card {
			background: #fff;
			border-radius: 14px;
			border: 1px solid #ede4d8;
			padding: 22px 20px;
			text-align: center;
			margin-bottom: 12px;
			}
			.visit-card p {
			font-size: 13px;
			color: #8a6040;
			font-weight: 300;
			margin-bottom: 14px;
			line-height: 1.6;
			}
			.visit-btn {
			display: inline-block;
			background: #7a331d;
			color: #ffe4c0;
			font-family: 'Geist', sans-serif;
			font-size: 13px;
			font-weight: 500;
			padding: 11px 32px;
			border-radius: 8px;
			text-decoration: none;
			border: none;
			cursor: pointer;
			}
			/* FOOTER */
			.footer {
			background: #1a1208;
			padding: 24px 28px;
			text-align: center;
			}
			.f-brand {
			font-family: 'Instrument Serif', serif;
			font-size: 16px;
			color: rgba(255,228,192,0.6);
			margin-bottom: 4px;
			}
			.f-sub {
			font-size: 11px;
			color: rgba(255,228,192,0.25);
			font-weight: 300;
			line-height: 1.6;
			}
			@media (max-width: 480px) {
			.header { padding: 32px 24px 24px; }
			.hero { padding: 36px 24px; }
			.hero h1 { font-size: 26px; }
			.body { padding: 16px 12px; }
			.footer { padding: 20px 20px; }
			}
		</style>
	</head>
	<body>
		<div class="wrap">
			<!-- HEADER -->
			<div class="header">
				<div class="logo">
					@if(!empty($data['logo_url']))
                        <img src="{{ $data['logo_url'] }}" alt="Logo" class="logo" style="margin-bottom: 20px;">
                    @endif
				</div>
				<span class="brand">Ceylon Bake House</span>
				<span class="tagline">A Legacy of Flavour Since 1953</span>
			</div>
			<!-- HERO -->
			<div class="hero">
				<div class="thank-icon">
					<svg viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5 14l6 6L23 8" stroke="#ffe4c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>
				<h1>Thank You for Your Feedback</h1>
				<p>Your words mean the world to us. Every thought you've shared helps us serve you better and honour our legacy of warmth.</p>
			</div>
			<!-- BODY -->
			<div class="body">
				<!-- SUMMARY -->
				<div class="card">
					<div class="score-row">
						<div>
							<div class="score-num">{{ $data->fe_feedback }}</div>
							<div class="score-sub">Your rating</div>
						</div>
						<div class="score-divider"></div>
						<!-- <div class="stars-wrap">
							<div class="stars">
								<svg viewBox="0 0 14 14" fill="none">
									<path d="M7 1l1.57 3.18 3.51.51-2.54 2.48.6 3.49L7 8.9 4.86 10.66l.6-3.49L2.92 4.69l3.51-.51L7 1z" fill="#c8761a"/>
								</svg>
								<svg viewBox="0 0 14 14" fill="none">
									<path d="M7 1l1.57 3.18 3.51.51-2.54 2.48.6 3.49L7 8.9 4.86 10.66l.6-3.49L2.92 4.69l3.51-.51L7 1z" fill="#c8761a"/>
								</svg>
								<svg viewBox="0 0 14 14" fill="none">
									<path d="M7 1l1.57 3.18 3.51.51-2.54 2.48.6 3.49L7 8.9 4.86 10.66l.6-3.49L2.92 4.69l3.51-.51L7 1z" fill="#c8761a"/>
								</svg>
								<svg viewBox="0 0 14 14" fill="none">
									<path d="M7 1l1.57 3.18 3.51.51-2.54 2.48.6 3.49L7 8.9 4.86 10.66l.6-3.49L2.92 4.69l3.51-.51L7 1z" fill="#c8761a"/>
								</svg>
								<svg viewBox="0 0 14 14" fill="none">
									<path d="M7 1l1.57 3.18 3.51.51-2.54 2.48.6 3.49L7 8.9 4.86 10.66l.6-3.49L2.92 4.69l3.51-.51L7 1z" fill="none" stroke="#c8761a" stroke-width="1.2"/>
								</svg>
							</div>
							<div class="score-note">Overall satisfaction</div>
						</div> -->
					</div>
					<div class="summary-row">
						<span class="s-label">Guest name</span>
						<span class="s-val brown"> - {{ $data->fe_name }}</span>
					</div>
					<div class="summary-row">
						<span class="s-label">Room</span>
						<span class="s-val"> - Room {{ $data->fe_room_no }}</span>
					</div>
					<div class="summary-row">
						<span class="s-label">Date</span>
						<span class="s-val"> - {{ $data->fe_date }}</span>
					</div>
					<div class="summary-row">
						<span class="s-label">Visit again</span>
						<span class="s-val brown"> - {{ $data->fe_stay_with_us_again }} </span>
					</div>
					<div class="summary-row">
						<span class="s-label">Would recommend</span>
						<span class="s-val brown"> - {{ $data->fe_recommend }} </span>
					</div>
				</div>
				<!-- PERSONAL MESSAGE -->
				<div class="card">
					<div class="msg-box">
						<p>"Dear {{ $data->fe_name }}, your kind words have truly warmed our hearts. We are glad the flavours and warmth of Ceylon Bake House made your stay memorable. We have noted your suggestions and will work on making every corner of your experience perfect."</p>
						<div class="msg-sig">
							<strong>The Ceylon Bake House Team</strong>
							manager@ceylonbakehouse.com · +94 11 234 5678
						</div>
					</div>
				</div>
				<!-- VISIT AGAIN -->
				<!-- <div class="visit-card">
					<p>We would love to welcome you back. Book your next visit and experience the warmth of our legacy once more.</p>
					<a href="#" class="visit-btn">Book Your Next Visit</a>
				</div> -->
			</div>
			<!-- FOOTER -->
			<div class="footer">
				<div class="f-brand">Ceylon Bake House</div>
				<div class="f-sub">A Legacy of Flavour Since 1953<br>Colombo, Sri Lanka</div>
			</div>
		</div>
	</body>
</html>