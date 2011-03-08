<?php if ( ! empty($is_supadmin)): ?>
	<?php echo html::anchor('admin/restaurants/add','add restaurant');?> |
	<?php echo html::anchor('admin/users/add','add user');?> |
    <?php echo html::anchor('admin/ingredients/add','add ingredient');?> |
    <?php echo html::anchor('admin/ingredientcategories/add','add ingredient category');?> |
<?php endif;?>
<?php echo html::anchor('admin/users/add/'.$_SESSION['auth_user_munch']->id,'Edit my profile');?>
<?php if (count($user_rest) > 0): ?>
<h1>List Of My Restaurant</h1>
<ul class="dashbord_rest">
	<?php foreach($user_rest as $rest) { ?>
			<li><?php echo html::anchor('admin/restaurants/add/'.$rest->id,'edit '.$rest->name); ?></li>
			<li><?php echo $rest->user_id; ?></li>
			<li><?php echo $rest->name; ?></li>
			<li><?php echo $rest->email; ?></li>
			<li><?php echo $rest->phone; ?></li>
	<?php } ?>
</ul>
<?php else : ?>
	<h1>You Don't Have Any Restaurant At our system </h1>
<?php endif;?>
<?php if ( ! empty($is_supadmin)): ?>
	<h1>List Of All Users</h1>
	<ul class="dashbord_user">
		<?php foreach($all_users as $user) { ?>
				<li><?php echo html::anchor('admin/users/add/'.$user->id,'edit '.$user->username); ?></li>
				<li><?php echo $user->email; ?></li>
		<?php } ?>
	</ul>
    <h1>List Of All Ingredients</h1>
        <ul class="dashbord_ingredients">
		<?php foreach($all_ingredients as $ingredient) { ?>
				<li><?php echo html::anchor('admin/ingredients/add/'.$ingredient->id,'edit '.$ingredient->name); ?></li>

		<?php } ?>
	</ul>
        <h1>List Of All Ingredients Categories</h1>
        <ul class="dashbord_ingredientcategories">
		<?php foreach($all_ingredientcategories as $ingredientcategory) { ?>
				<li><?php echo html::anchor('admin/ingredientcategories/add/'.$ingredientcategory->id,'edit '.$ingredientcategory->name); ?></li>

		<?php } ?>
	</ul>


<?php endif;?>
<div class="clear"></div>

