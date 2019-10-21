import ProgramsRepository from 'Repositories/programsRepository';
import TemplatesRepository from 'Repositories/templatesRepository';
import AuthRepository from 'Repositories/authRepository';

const repositories = {
    programs: ProgramsRepository,
    templates: TemplatesRepository,
    auth: AuthRepository
    //Other Repositories here...
}

export const RepositoryFactory = {
    get: name => repositories[name]
}

export default {
    ProgramsRepository,
    TemplatesRepository,
    AuthRepository
}