import * as request from 'supertest';
import { Test } from '@nestjs/testing';
import { INestApplication, ValidationPipe } from '@nestjs/common';
import { useContainer } from 'class-validator';
import { AuthModule } from './auth.module';
import { OrmModule } from '../orm/orm.module';
import { AppModule } from '../app.module';
import { MailsService } from '../mails/mails.service';
import Tokens from './types/tokens';

describe('Auth', () => {
	let app: INestApplication;
	const mailsService = { sendVerifyEmail: () => {} };
	let tokens: Tokens;

	beforeAll(async () => {
		const module = await Test.createTestingModule({
			imports: [
				AppModule,
				AuthModule,
				OrmModule,
			],
		})
			.overrideProvider(MailsService)
			.useValue(mailsService)
			.compile();

		app = module.createNestApplication();

		useContainer(app.select(AppModule), {
			fallbackOnErrors: true,
		});

		app.useGlobalPipes(new ValidationPipe());

		await app.init();
	});

	it('@POST /auth/register', () => {
		return request(app.getHttpServer())
			.post('/auth/register')
			.send('email=test@test.es')
			.send('password=123456')
			.send('lang=es')
			.expect(201);
	});

	it('@POST /auth/login', () => {
		return request(app.getHttpServer())
			.post('/auth/login')
			.send('email=test@test.es')
			.send('password=123456')
			.expect(200)
			.then((response) => {
				tokens = response.body;
			});
	});

	it('@POST /auth/refresh', () => {
		return request(app.getHttpServer())
			.post('/auth/refresh')
			.set('Authorization', 'Bearer ' + tokens.access_token)
			.send('email=test@test.es')
			.send('refreshToken=' + tokens.refresh_token)
			.expect(201)
			.then((response) => {
				tokens = response.body;
			});
	});

	afterAll(async () => {
		await app.close();
	});
});
