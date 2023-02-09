<div class="menu">
			<ul class="list">
				<li class="header">MAIN NAVIGATION</li>
				<li<?php if($menu=="home") { echo ' class="active"'; } ?>><a href="home.php"><i class="material-icons">home</i><span>Home</span></a></li>
				
				<li<?php if($menu=="users") { echo ' class="active"'; } ?>><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">account_box</i><span>USERS</span></a>
					<ul class="ml-menu">
						<li<?php if($submenu=="user-list") { echo ' class="active"'; } ?>><a href="user_list.php"><span>Users List</span></a></li>
						<li<?php if($submenu=="user-verify") { echo ' class="active"'; } ?>><a href="user_verify.php"><span>User Verify</span></a></li>
						<li<?php if($submenu=="user-corpo-add") { echo ' class="active"'; } ?>><a href="user_corporate_add.php"><span>Add Corporate User</span></a></li>
					</ul>
				</li>
				
				<li<?php if($menu=="posts") { echo ' class="active"'; } ?>><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">receipt</i><span>POST / NEWS</span></a>
					<ul class="ml-menu">
						<li<?php if($submenu=="post-approve") { echo ' class="active"'; } ?>><a href="post_approve.php"><span>Post Approve</span></a></li>
						<li<?php if($submenu=="news-approve") { echo ' class="active"'; } ?>><a href="news_approve.php"><span>News Approve</span></a></li>
						<li<?php if($submenu=="news-add") { echo ' class="active"'; } ?>><a href="news_add.php"><span>Add News</span></a></li>
					</ul>
				</li>
				
				<li<?php if($menu=="ads") { echo ' class="active"'; } ?>><a href="ads.php"><i class="material-icons">dns</i><span>Manage Ads</span></a></li>
				
				<li<?php if($menu=="txn") { echo ' class="active"'; } ?>><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons"> business_center</i><span>TRANSACTIONS</span></a>
					<ul class="ml-menu">
						<li<?php if($submenu=="txn-success") { echo ' class="active"'; } ?>><a href="transactions.php?result=SUCCESS"><span>Success</span></a></li>
						<li<?php if($submenu=="txn-fail") { echo ' class="active"'; } ?>><a href="transactions.php?result=FAIL"><span>Fail</span></a></li>
						<li<?php if($submenu=="txn-cancel") { echo ' class="active"'; } ?>><a href="transactions.php?result=CANCEL"><span>Cancel</span></a></li>
					</ul>
				</li>
				
				<li<?php if($menu=="settings") { echo ' class="active"'; } ?>><a href="settings.php"><i class="material-icons">settings</i><span>Settings</span></a></li>

				<li><a href="../admin/index.php"><i class="material-icons">launch</i><span>Basic Text Version</span></a></li>
				<li><a href="logout.php"><i class="material-icons">exit_to_app</i><span>Logout</span></a></li>
			</ul>
		</div>
