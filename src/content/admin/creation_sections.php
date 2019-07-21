<div id="tuning_section" class="quiz_creation_section">
	<h4>Tuning</h4>
	<form id="tuning_form" class="tuning_form quiz_creation_form">
		<div class="form-group row">
			<label for="quizName" class="col-sm-3 col-form-label">Name of quiz</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="quizName" name="quiz_name" placeholder="Name of quiz" autocomplete="off">
			</div>
		</div>

		<div class="form-group row">
			<label for="quizDescription" class="col-sm-3 col-form-label">Quiz description</label>
				<div class="col-sm-9">
				<textarea class="form-control" name="quiz_descr" id="quizDescription" rows="3"></textarea>
			</div>
		</div>

		<a href="#questions" class="btn btn-success page_change">Next</a>
	</form>
</div>


<div id="questions_section" class="quiz_creation_section">
	<h4>Questions</h4>
	<form id="question_form" class="row">

		<div class="question_block col-md-3">
			<div class="list-group">
				<a href="question_0" class="question list-group-item list-group-item-action active">Question</a>
			</div>
			<button type="button" id="add_question_btn" class="btn btn-outline-primary btn-block">Add a question</button>
		</div>

		<div id="question_0" class="question_setting col-md-9">

			<p class="font-weight-bold d-inline-block">Question setting</p>

			<div class="form-group">
				<label>Question</label>
				<input type="text" class="form-control question_name" placeholder="Enter a question" autocomplete="off">
			</div>

			<div class="form-group">
				<label>Description for the question</label>
				<input type="text" class="form-control question_descr" placeholder="Enter a description for the question" autocomplete="off">
			</div>

			<div class="form-group">
				<label>How many answer choices can I choose?</label>
				<select class="form-control answer_choices">
					<option value="One">One</option>
					<option value="Several">Several</option>
				</select>
			</div>

			<p class="font-weight-bold">Answer options</p>
			<div class="answers_block">

				<div class="form-group answer">
					<input type="text" class="form-control" placeholder="Enter answer option" autocomplete="off">
				</div>

				<div class="form-group answer">
					<input type="text" class="form-control" placeholder="Enter answer option" autocomplete="off">
				</div>

				<div class="form-group row answer">
					<div class="col-sm-11">
						<input type="text" class="form-control" placeholder="Enter answer option" autocomplete="off">
					</div>

					<div class="col-sm-1">
						<div class="remove_answer ml-auto"></div>
					</div>
				</div>

				<button type="button" class="btn btn-outline-primary btn-block add_answer">Add answer option</button>
			</div>

		</div>

		<a href="#contacts" class="btn btn-success page_change">Next</a>
	</form>
</div>

<div id="contacts_section" class="quiz_creation_section">
	<h4>Configuring the collection of contacts</h4>
	<form id="contacts_form">
		<div class="form-group">
			<label>Contact block header</label>
			<input type="text" class="form-control" id="cb_header" name="contact_block_header" placeholder="Enter title" autocomplete="off" >
		</div>

		<div class="form-group">
			<label>Subtitle of the block of contacts</label>
			<input type="text" class="form-control" name="contact_block_descr" placeholder="Enter subtitle" autocomplete="off" >
		</div>

		<label>What data must enter the user to send the test results?</label>

		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="user_name" id="customCheck1">
			<label class="custom-control-label" for="customCheck1">Name</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="user_phone" id="customCheck2">
			<label class="custom-control-label" for="customCheck2">Phone number</label>
		</div>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="user_email"  id="customCheck3">
			<label class="custom-control-label" for="customCheck3">Email</label>
		</div><br>

		<div class="form-group">
			<label>What email should test results come in?</label>
			<input type="email" class="form-control" id="recipient" name="recipient" placeholder="Enter email"  autocomplete="off">
		</div>
		<a href="#download" id="generateQuiz" class="btn btn-success">Next</a>
	</form>

</div>
