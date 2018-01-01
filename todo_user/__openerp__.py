{
    'name': 'Multiuser To-Do',
    'description': 'Extend the To-Do app to multiuser.',
    'author': 'Daniel Reis',
    'depends': ['todo_app', 'mail'],
    'data': [
        'todo_view.xml',
        'security/todo_access_rules.xml',
    ],
    'demo': [
        'demo/todo.task.csv',
        'demo/todo_data.xml',
    ]
}
