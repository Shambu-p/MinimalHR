<?php

$config = array(
	'Employees/register_employee' => [
		[
			'field' => 'full_name',
			'label' => 'full_name',
			'rules' => 'required|alpha|max_length[100]|min_length[10]'
		],
		[
			'field' => 'email',
			'label' => 'email',
			'rules' => 'required|valid_email|is_unique[Employee.email]|max_length[50]'
		],
		[
			'field' => 'profile_picture',
			'label' => 'profile_picture',
			'rules' => 'required'
		],
		[
			'field' => 'documents',
			'label' => 'documents',
			'rules' => 'required'
		],
		[
			'field' => 'salary',
			'label' => 'salary',
			'rules' => 'required|numeric'
		],
		[
			'field' => 'phone_number',
			'label' => 'phone_number',
			'rules' => 'required|trim|regex_match[/\(\+2519\)|\(09\)\d{8}/]|max_length[14]'
		],
		[
			'field' => 'education_level',
			'label' => 'education_level',
			'rules' => 'required|in_list[ba, bsc, beng, llb, marts, mbiol, mcomp, meng, mmath, mphys, msci, ma, msc, mba, mphil, mres, llm, phd]'
		],
		[
			'field' => 'department_id',
			'label' => 'department_id',
			'rules' => 'required|integer'
		],
		[
			'field' => 'position',
			'label' => 'position',
			'rules' => 'required|alpha|max_length[100]'
		]
	]
);
