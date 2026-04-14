<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Guest Feedback – Ceylon Hotels</title>
		<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500;600&display=swap" rel="stylesheet">
		<style>
			* { box-sizing: border-box; margin: 0; padding: 0; }
			body {
			background: #f5f0ea;
			font-family: 'Geist', sans-serif;
			color: #1a1208;
			-webkit-font-smoothing: antialiased;
			}
			.wrap {
			max-width: 620px;
			margin: 0 auto;
			background: #f5f0ea;
			}
			/* TOP BAR */
			.topbar {
			background: #1a1208;
			padding: 10px 28px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			}
			.topbar-left {
			display: flex;
			align-items: center;
			gap: 8px;
			}
			.live-dot {
			width: 6px; height: 6px;
			border-radius: 50%;
			background: #d4824a;
			animation: pulse 2s infinite;
			}
			@keyframes pulse {
			0%, 100% { opacity: 1; }
			50% { opacity: 0.4; }
			}
			.topbar-text {
			font-size: 11px;
			font-weight: 500;
			color: rgba(255,255,255,0.55);
			letter-spacing: 0.8px;
			text-transform: uppercase;
			}
			.topbar-time {
			font-size: 11px;
			color: rgba(255,255,255,0.3);
			font-weight: 300;
			}
			/* HEADER */
			.header {
			background: #fff;
			padding: 32px 28px 24px;
			border-bottom: 1px solid #ede6db;
			display: flex;
			align-items: center;
			gap: 16px;
			}
			.logo-box {
			width: 48px; height: 48px;
			background: #7a331d;
			border-radius: 12px;
			display: flex; align-items: center; justify-content: center;
			flex-shrink: 0;
			}
			.logo-box svg { width: 26px; height: 26px; }
			.header-info h1 {
			font-family: 'Instrument Serif', serif;
			font-size: 20px;
			color: #1a1208;
			font-weight: 400;
			line-height: 1.2;
			}
			.header-info p {
			font-size: 12px;
			color: #9a8070;
			margin-top: 3px;
			font-weight: 300;
			}
			.new-badge {
			margin-left: auto;
			background: #fdf0e8;
			border: 1px solid #e8c4a0;
			color: #7a331d;
			font-size: 11px;
			font-weight: 600;
			padding: 5px 12px;
			border-radius: 20px;
			flex-shrink: 0;
			letter-spacing: 0.3px;
			}
			/* SCORE STRIP */
			.score-strip {
			background: #7a331d;
			padding: 20px 28px;
			display: flex;
			align-items: center;
			gap: 20px;
			}
			.score-big {
			font-family: 'Instrument Serif', serif;
			font-size: 40px;
			color: #ffe4c0;
			line-height: 1;
			}
			.score-denom {
			font-size: 13px;
			color: rgba(255,228,192,0.5);
			margin-top: 2px;
			font-weight: 300;
			}
			.score-divider {
			width: 1px;
			height: 36px;
			background: rgba(255,228,192,0.2);
			flex-shrink: 0;
			}
			.score-meta {
			flex: 1;
			}
			.score-stars {
			display: flex;
			gap: 3px;
			margin-bottom: 5px;
			}
			.score-stars svg { width: 13px; height: 13px; }
			.score-meta-text {
			font-size: 12px;
			color: rgba(255,228,192,0.55);
			font-weight: 300;
			}
			.score-tags {
			display: flex;
			gap: 8px;
			margin-left: auto;
			flex-shrink: 0;
			}
			.stag {
			background: rgba(255,228,192,0.12);
			border: 1px solid rgba(255,228,192,0.18);
			border-radius: 8px;
			padding: 6px 12px;
			text-align: center;
			}
			.stag-l { font-size: 10px; color: rgba(255,228,192,0.4); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 2px; }
			.stag-v { font-size: 13px; color: #ffe4c0; font-weight: 500; }
			/* BODY */
			.body { padding: 20px 20px 0; }
			/* CARD */
			.card {
			background: #fff;
			border-radius: 14px;
			border: 1px solid #ede6db;
			overflow: hidden;
			margin-bottom: 12px;
			}
			.card-head {
			padding: 14px 18px 12px;
			border-bottom: 1px solid #f0e8de;
			display: flex;
			align-items: center;
			gap: 10px;
			}
			.card-icon {
			width: 30px; height: 30px;
			border-radius: 8px;
			background: #fdf0e8;
			display: flex; align-items: center; justify-content: center;
			flex-shrink: 0;
			}
			.card-icon svg { width: 15px; height: 15px; }
			.card-title {
			font-size: 13px;
			font-weight: 600;
			color: #3a2010;
			letter-spacing: 0.1px;
			}
			.card-count {
			margin-left: auto;
			font-size: 11px;
			color: #b09070;
			font-weight: 300;
			}
			/* GUEST GRID */
			.guest-grid {
			display: grid;
			grid-template-columns: 1fr 1fr;
			}
			.gf {
			padding: 12px 18px;
			border-bottom: 1px solid #f5ede4;
			border-right: 1px solid #f5ede4;
			}
			.gf:nth-child(even) { border-right: none; }
			.gf:nth-last-child(-n+2) { border-bottom: none; }
			.gf.full { grid-column: 1 / -1; border-right: none; }
			.gf.full:last-child { border-bottom: none; }
			.gf-label {
			font-size: 10px;
			text-transform: uppercase;
			letter-spacing: 0.9px;
			color: #b09070;
			font-weight: 500;
			margin-bottom: 3px;
			}
			.gf-val {
			font-size: 13.5px;
			color: #1a1208;
			font-weight: 400;
			}
			.gf-val.em { color: #7a331d; font-weight: 500; }
			/* RATINGS */
			.rating-row {
			display: flex;
			align-items: center;
			gap: 10px;
			padding: 10px 18px;
			border-bottom: 1px solid #f5ede4;
			}
			.rating-row:last-child { border-bottom: none; }
			.r-name {
			font-size: 12.5px;
			color: #5a3820;
			flex: 0 0 148px;
			}
			.r-bar {
			flex: 1;
			height: 5px;
			background: #f0e8de;
			border-radius: 3px;
			overflow: hidden;
			}
			.r-fill {
			height: 100%;
			border-radius: 3px;
			}
			.fill-5 { background: #5a8a3a; width: 100%; }
			.fill-4 { background: #8ab43a; width: 80%; }
			.fill-3 { background: #c8921a; width: 60%; }
			.fill-2 { background: #c85a1a; width: 40%; }
			.fill-1 { background: #b03020; width: 20%; }
			.r-score {
			font-size: 12px;
			font-weight: 600;
			color: #5a3820;
			flex-shrink: 0;
			width: 28px;
			text-align: right;
			}
			/* STARS MINI */
			.r-stars { display: flex; gap: 2px; flex-shrink: 0; }
			.r-stars svg { width: 10px; height: 10px; }
			/* YES/NO */
			.yn-row {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 12px 18px;
			border-bottom: 1px solid #f5ede4;
			gap: 12px;
			}
			.yn-row:last-child { border-bottom: none; }
			.yn-label { font-size: 13px; color: #5a3820; }
			.yn-pill {
			font-size: 11px;
			font-weight: 600;
			padding: 4px 14px;
			border-radius: 20px;
			flex-shrink: 0;
			}
			.yes { background: #eaf4e0; color: #3a6a1a; border: 1px solid #c0dca0; }
			.no  { background: #fce8e0; color: #8a2015; border: 1px solid #e0b0a0; }
			/* COMMENTS */
			.comment-item {
			padding: 14px 18px;
			border-bottom: 1px solid #f5ede4;
			}
			.comment-item:last-child { border-bottom: none; }
			.c-tag {
			font-size: 10px;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 0.9px;
			margin-bottom: 6px;
			display: flex;
			align-items: center;
			gap: 5px;
			}
			.c-dot {
			width: 5px; height: 5px;
			border-radius: 50%;
			flex-shrink: 0;
			}
			.tag-green { color: #4a7a20; }
			.tag-green .c-dot { background: #5a8a3a; }
			.tag-red { color: #8a2015; }
			.tag-red .c-dot { background: #b03020; }
			.tag-blue { color: #205a8a; }
			.tag-blue .c-dot { background: #3a6aaa; }
			.tag-gray { color: #9a8070; }
			.tag-gray .c-dot { background: #b09070; }
			.c-text {
			font-size: 13px;
			color: #3a2010;
			line-height: 1.65;
			font-style: italic;
			font-family: 'Instrument Serif', serif;
			}
			.c-empty {
			font-size: 12.5px;
			color: #c0a888;
			font-style: normal;
			font-family: 'Geist', sans-serif;
			}
			/* ACTIONS */
			.actions {
			display: flex;
			gap: 8px;
			padding: 12px 20px 20px;
			flex-wrap: wrap;
			}
			.btn {
			flex: 1;
			min-width: 120px;
			padding: 11px 16px;
			border-radius: 10px;
			font-family: 'Geist', sans-serif;
			font-size: 12.5px;
			font-weight: 500;
			cursor: pointer;
			border: none;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			transition: opacity 0.15s;
			}
			.btn:hover { opacity: 0.85; }
			.btn-p { background: #7a331d; color: #ffe4c0; }
			.btn-s { background: #fff; color: #7a331d; border: 1px solid #ddd0c0; }
			/* FOOTER */
			.footer {
			background: #1a1208;
			padding: 22px 28px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
			flex-wrap: wrap;
			}
			.f-brand {
			font-family: 'Instrument Serif', serif;
			font-size: 16px;
			color: rgba(255,228,192,0.7);
			}
			.f-sub { font-size: 11px; color: rgba(255,228,192,0.3); margin-top: 2px; }
			.f-note { font-size: 11px; color: rgba(255,228,192,0.25); text-align: right; line-height: 1.5; }
			@media (max-width: 520px) {
			.score-strip { flex-wrap: wrap; padding: 18px 20px; gap: 12px; }
			.score-tags { margin-left: 0; }
			.header { padding: 24px 20px; }
			.body { padding: 16px 12px 0; }
			.guest-grid { grid-template-columns: 1fr; }
			.gf { border-right: none !important; }
			.gf:nth-last-child(-n+2) { border-bottom: 1px solid #f5ede4; }
			.gf:last-child { border-bottom: none; }
			.r-name { flex: 0 0 110px; }
			.actions { padding: 10px 12px 16px; flex-direction: column; }
			.footer { padding: 18px 20px; }
			.f-note { text-align: left; }
			.topbar { padding: 10px 20px; }
			}
		</style>
	</head>
	<body>
		<div class="wrap">
			<!-- TOP BAR -->
			<div class="topbar">
				<div class="topbar-left">
					<div class="live-dot"></div>
					<span class="topbar-text">New Feedback Submitted</span>
				</div>
				<span class="topbar-time">{{ $data->fe_date }}</span>
			</div>
			<!-- HEADER -->
			<div class="header">
				<div class="logo-box">
					@if(!empty($data['logo_url']))
                        <img src="{{ $data['logo_url'] }}" alt="Logo" class="logo" style="margin-bottom: 20px;">
                    @endif
				</div>
				<div class="header-info">
					<h1>Ceylon Hotels</h1>
					<p>Guest Feedback Report · For Owner &amp; Front Desk</p>
				</div>
				<div class="new-badge">New</div>
			</div>
			<!-- SCORE STRIP -->
			<div class="score-strip">
				<div>

					<div class="score-big">{{ $data->fe_feedback }}</div>
					<div class="score-denom">out of 5</div>
				</div>
				<div class="score-divider"></div>
				<div class="score-meta">
                    @php
                        $mainRating = (int) $data->fe_feedback;
                    @endphp
					<div class="score-stars">
						@for($i = 1; $i <= 5; $i++)
                            @if($i <= $mainRating)
                                <svg viewBox="0 0 13 13">
                                    <path d="M6.5 1l1.47 2.98 3.29.48-2.38 2.32.56 3.27L6.5 8.55 3.56 10.05l.56-3.27L1.74 4.46l3.29-.48L6.5 1z"
                                        fill="#f0c070"/>
                                </svg>
                            @else
                                <svg viewBox="0 0 13 13">
                                    <path d="M6.5 1l1.47 2.98 3.29.48-2.38 2.32.56 3.27L6.5 8.55 3.56 10.05l.56-3.27L1.74 4.46l3.29-.48L6.5 1z"
                                        fill="none" stroke="rgba(240,192,112,0.45)" stroke-width="1.2"/>
                                </svg>
                            @endif
                        @endfor
					</div>
					<div class="score-meta-text">Room {{ $data->fe_room_no }} · Check-out {{ $data->fe_date }}</div>
				</div>
				<div class="score-tags">
					<div class="stag">
						<div class="stag-l">Return</div>
						<div class="stag-v">✓ {{ $data->fe_stay_with_us_again }}</div>
					</div>
					<div class="stag">
						<div class="stag-l">Recommend</div>
						<div class="stag-v">✓ {{ $data->fe_recommend }}</div>
					</div>
				</div>
			</div>
			<!-- BODY -->
			<div class="body">
				<!-- GUEST INFO -->
				<div class="card">
					<div class="card-head">
						<div class="card-icon">
							<svg viewBox="0 0 15 15" fill="none">
								<circle cx="7.5" cy="5" r="2.8" stroke="#7a331d" stroke-width="1.3"/>
								<path d="M2 13c0-3 2.5-5.5 5.5-5.5S13 10 13 13" stroke="#7a331d" stroke-width="1.3" stroke-linecap="round"/>
							</svg>
						</div>
						<span class="card-title">Guest Information</span>
					</div>
					<div class="guest-grid">
						<div class="gf">
							<div class="gf-label">Full Name</div>
							<div class="gf-val em">{{ $data->fe_name }}</div>
						</div>
						<div class="gf">
							<div class="gf-label">Room / Table No.</div>
							<div class="gf-val">Room {{ $data->fe_room_no }}</div>
						</div>
						<div class="gf">
							<div class="gf-label">Check-in Date</div>
							<div class="gf-val">{{ $data->fe_date }}</div>
						</div> 
						<div class="gf">
							<div class="gf-label">Phone Number</div>
							<div class="gf-val">{{ $data->fe_phone }}</div>
						</div>
						<div class="gf">
							<div class="gf-label">Email Address</div>
							<div class="gf-val">{{ $data->fe_email }}</div>
						</div>
					</div>
				</div>
				<!-- RATINGS -->
				@php
                    $ratings = [
                        'Check-in Process' => $data->fe_check_in_process,
                        'Staff Friendliness' => $data->fe_staff_friendliness,
                        'Cleanliness' => $data->fe_cleanliness,
                        'Bed Comfort' => $data->fe_bed_comfort,
                        'Bathroom' => $data->fe_bathroom,
                        'Room Maintenance' => $data->fe_room_maintenance,
                        'WiFi Quality' => $data->fe_wiFi_quality,
                        'Room Service' => $data->fe_room_service,
                        'Food Quality' => $data->fe_food_quality,
                        'Stay Experience' => $data->fe_stay_experience,
                        'Value for Money' => $data->fe_value_for_money,
                    ];
                    @endphp

                <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; font-family: Arial;">
                    @foreach($ratings as $label => $value)
                        @php
                            $rating = (int) $value;
                            $percent = ($rating / 4) * 100;

                            if ($rating >= 4) {
                                $color = '#5a8a3a';
                            } elseif ($rating == 3) {
                                $color = '#c8921a';
                            } else {
                                $color = '#c85a1a';
                            }

                            // Stars (email safe)
                            $stars = str_repeat('★', $rating) . str_repeat('☆', 4 - $rating);
                        @endphp

                        <tr style="border-bottom:1px solid #eee;">
                            <td width="30%" style="font-size:13px; color:#333;">
                                {{ $label }}
                            </td>

                            <!-- Progress Bar -->
                            <td width="40%">
                                <div style="background:#eee; height:6px; border-radius:3px;">
                                    <div style="width:{{ $percent }}%; background:{{ $color }}; height:6px; border-radius:3px;"></div>
                                </div>
                            </td>

                            <!-- Stars -->
                            <td width="20%" style="color:#c8761a; font-size:14px;">
                                {{ $stars }}
                            </td>

                            <!-- Score -->
                            <td width="10%" style="font-size:12px; text-align:right;">
                                {{ $rating }}/4
                            </td>
                        </tr>
                    @endforeach
                </table>
				<!-- YES / NO -->
				 
				<!-- COMMENTS -->
				<div class="card">
					<div class="card-head">
						<div class="card-icon">
							<svg viewBox="0 0 15 15" fill="none">
								<path d="M2 2.5h11v8H2z" stroke="#7a331d" stroke-width="1.2" stroke-linejoin="round"/>
								<path d="M4.5 13l1.5-2.5h3L10.5 13" stroke="#7a331d" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M4.5 5.5h6M4.5 7.5h4" stroke="#7a331d" stroke-width="1" stroke-linecap="round" opacity="0.5"/>
							</svg>
						</div>
						<span class="card-title">Guest Comments</span>
					</div>
					<div class="comment-item">
						<div class="c-tag tag-green"><span class="c-dot"></span>What they liked</div>
						<div class="c-text">"{{$data->fe_like}}"</div>
					</div>
					<div class="comment-item">
						<div class="c-tag tag-red"><span class="c-dot"></span>Areas to improve</div>
						<div class="c-text">"{{$data->fe_improve}}"</div>
					</div>
					<div class="comment-item">
						<div class="c-tag tag-blue"><span class="c-dot"></span>Words of appreciation</div>
						<div class="c-text">"{{$data->fe_appreciate}}"</div>
					</div>
					<!-- <div class="comment-item">
						<div class="c-tag tag-gray"><span class="c-dot"></span>Additional feedback</div>
						<div class="c-empty">No additional feedback provided.</div>
					</div> -->
				</div>
				<!-- ACTIONS -->
				 
			</div>
			<!-- /body -->
			<!-- FOOTER -->
			<div class="footer">
				<div>
					<div class="f-brand">Ceylon Hotels</div>
					<div class="f-sub">Internal report · Owner &amp; Front Desk</div>
				</div>
				<div class="f-note">Automated notification.<br>Do not reply to this email.</div>
			</div>
		</div>
	</body>
</html>