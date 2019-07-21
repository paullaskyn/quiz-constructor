<div class="container content-start">

	<div class="top_header_block">
		<h2 class="page_header d-inline-block">Quizzes</h2>
		<a href="/quiz_creation" class="btn btn-success d-inline-block">Create quiz</a>
	</div>

	<div class="quizzes_block">
		<?php #for ($i = 0; $i < $quizzes['quiz_count']; $i++) {?>
			<div class="quiz_block row">
				<div class="col-lg-3 align-middle quiz_name">
					<p><?  #$quizzes['quiz_preview'][$i]['quiz_name'] ?></p>
				</div>
				<div class="col-lg-4 align-middle quiz_descr">
					<?php #if ($quizzes['quiz_preview'][$i]['status'] == 'ready') : ?>
						<span class="badge badge-primary">Ready</span>
					<?php #else :?>
						<span class="badge badge-warning">Draft</span>
					<?php #endif;?>
				</div>
				<div class="col-lg-5 align-middle">
					<div class="control_buttons" quizid="<? #$quizzes['quiz_preview'][$i]['id'] ?>">
						<?php #if ($quizzes['quiz_preview'][$i]['status'] == 'ready') : ?>
						<!--	<button type="button" class="btn btn-success">Скачать</button>-->
						<?php #endif;?>
						<button type="button" class="btn btn-primary edit_quiz">Edit</button>
						<button type="button" class="btn btn-danger delete_quiz">Delete</button>
					</div>
				</div>
			</div>
		<?php # }}else{ ?>
			<h3>You have no quiz yet</h3>
		<?php #} ?>
	</div>

</div>
