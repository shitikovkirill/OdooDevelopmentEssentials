# -*- coding: utf-8 -*-
from openerp import models, fields, api
from openerp.addons.base.res import res_request
from openerp.exceptions import ValidationError

class Tag(models.Model):
    _name = 'todo.task.tag'
    name = fields.Char('Name')
    task_ids = fields.Many2many(
        'todo.task',
        # related model
        string='Tasks')
    parent_id = fields.Many2one(
        'todo.task.tag', 'Parent Tag', ondelete='restrict')
    parent_left = fields.Integer('Parent Left', index=True)
    parent_right = fields.Integer('Parent Right', index=True)


class Stage(models.Model):
    _name = 'todo.task.stage'
    _order = 'sequence,name'
    _rec_name = 'name'  # the default
    _table = 'todo_task_stage'  # the default
    name = fields.Char('Name')
    desc = fields.Text('Description')
    state = fields.Selection(
        [('draft', 'New'), ('open', 'Started'), ('done', 'Closed')],
        'State')
    docs = fields.Html('Documentation')
    # Numeric fields:
    sequence = fields.Integer('Sequence')
    perc_complete = fields.Float('% Complete', (3, 2))
    # Date fields:
    date_effective = fields.Date('Effective Date')
    date_changed = fields.Datetime('Last Changed')
    # Other fields:
    fold = fields.Boolean('Folded?')
    image = fields.Binary('Image')

    tasks = fields.One2many(
        'todo.task',
        # related model
        'stage_id',
        # field for "this" on related model
        'Tasks in this stage')

def referencable_models(self):
    return res_request.referencable_models(
        self, self.env.cr, self.env.uid, context=self.env.context)

class TodoTask(models.Model):
    _inherit = 'todo.task'

    _sql_constraints = [
        ('todo_task_name_uniq',
         'UNIQUE (name, user_id, active)',
         'Task title must be unique!')]

    stage_id = fields.Many2one('todo.task.stage', 'Stage')
    # TodoTask class: Task <-> Tag relation (long form):
    tag_ids = fields.Many2many(
        comodel_name='todo.task.tag',  # related model
        relation='todo_task_tag_rel',  # relation table name
        column1='task_id',
        # field for "this" record
        column2='tag_id',
        # field for "other" record
        string='Tasks')

    # Old api
    #refers_to = fields.Reference(
    #    [('res.user', 'User'), ('res.partner', 'Partner')],
    #    'Refers to')

    refers_to = fields.Reference(
        referencable_models, 'Refers to')

    stage_fold = fields.Boolean(
        string='Stage Folded?',
        compute='_compute_stage_fold',
        # store=False) # the default
        search='_search_stage_fold',
        inverse='_write_stage_fold')

    @api.one
    @api.depends('stage_id.fold')
    def _compute_stage_fold(self):
        self.stage_fold = self.stage_id.fold

    def _search_stage_fold(self, operator, value):
        return [('stage_id.fold', operator, value)]

    def _write_stage_fold(self):
        self.stage_id.fold = self.stage_fold

    stage_state = fields.Selection(
        related='stage_id.state',
        string='Stage State')

    @api.one
    @api.constrains('name')
    def _check_name_size(self):
        if len(self.name) < 5:
            raise ValidationError('Must have 5 chars!')

    @api.one
    def compute_user_todo_count(self):
        self.user_todo_count = self.search_count(
            [('user_id', '=', self.user_id.id)])

    user_todo_count = fields.Integer(
        'User To-Do Count',
        compute='compute_user_todo_count')

