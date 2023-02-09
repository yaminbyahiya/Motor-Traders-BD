<!-- User Info -->
		<div class="user-info">
			<div class="image">
				<img src="images/user.png" width="48" height="48" alt="User" />
			</div>
			<div class="info-container">
				<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ADMIN</div>
				<div class="email"><i class="material-icons" style='font-size:16px;'>person</i> <?php echo $u; ?></div>
				<div class="btn-group user-helper-dropdown">
					<i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
					<ul class="dropdown-menu pull-right">
						<!--
						<li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
						<li role="seperator" class="divider"></li>
						<li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
						<li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
						<li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
						<li role="seperator" class="divider"></li>
						-->
						<li><a href="logout.php"><i class="material-icons">input</i>Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
