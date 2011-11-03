TRUNCATE `assando-sites`.`information`;
TRUNCATE `assando-sites`.`files`;
TRUNCATE `assando-sites`.`lessons_students`;
TRUNCATE `assando-sites`.`lessons`;
TRUNCATE `assando-sites`.`classes_students`;
TRUNCATE `assando-sites`.`students`;
TRUNCATE `assando-sites`.`classes`;

-- Turmas
INSERT INTO `assando-sites`.`classes` (`id`, `code`, `title`, `start`, `end`, `price`, `status_id`, `created`, `updated`) SELECT t.id, t.codigo, t.nome, t.inicio, t.fim, t.valor, IF (t.inscricoes, 5, IF (t.inicio > NOW(), 4, IF (t.fim < NOW(), 7, 6))), t.created, t.updated FROM `curso-cakephp`.`turmas` AS t;

-- Alunos
INSERT INTO `assando-sites`.`students` (`id`, `name`, `surname`, `email`, `password`, `status_id`, `created`, `updated`) SELECT a.id, a.nome, a.sobrenome, a.email, a.senha, IF (status_id = 1, 9, 8), created, updated FROM `curso-cakephp`.`alunos` AS a WHERE a.status_id <= 2;

-- Informações
INSERT INTO `assando-sites`.`information` (student_id, cpf, phone, twitter, state, city) SELECT i.aluno_id, i.CPF, i.telefone, i.twitter, i.estado, i.cidade FROM `curso-cakephp`.`informacoes` AS i INNER JOIN `curso-cakephp`.`alunos` AS a ON a.id = i.aluno_id AND a.status_id <= 2;

-- Alunos HABTM Turmas
INSERT INTO `assando-sites`.`classes_students` (`student_id`, `class_id`) SELECT a.aluno_id, a.turma_id FROM `curso-cakephp`.`alunos_turmas` AS a INNER JOIN `curso-cakephp`.`alunos` AS al ON al.id = a.aluno_id AND al.status_id <= 2;

-- Aulas
INSERT INTO `assando-sites`.`lessons` (`class_id`, `title`, `description`, `datetime`, `length`) SELECT a.turma_id, a.titulo, a.descricao, a.inicio, 180 FROM `curso-cakephp`.`aulas` AS a;

-- Alunos HABTM Aulas
INSERT INTO `assando-sites`.`lessons_students` (`student_id`, `lesson_id`, `length`) SELECT a.aluno_id, a.aula_id, a.participacao FROM `curso-cakephp`.`alunos_aulas` AS a INNER JOIN `assando-sites`.`lessons` AS l ON l.id = a.aula_id;

-- Arquivos
INSERT INTO `assando-sites`.`files` (class_id, title, description, location, status_id, created) SELECT a.turma_id, a.titulo, a.descricao, a.arquivo, 1, a.created FROM `curso-cakephp`.`arquivos` AS a INNER JOIN `assando-sites`.`classes` AS c ON c.id = a.turma_id;
