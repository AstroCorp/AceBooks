import { Controller, UseGuards, Post, Request, Body, HttpCode } from '@nestjs/common';
import { ApiTags, ApiBody } from '@nestjs/swagger';
import { LocalAuthGuard } from './guards/local-auth.guard';
import { AuthService } from './auth.service';
import { CreateUserDto } from './validation/createUserDto';
import { RefreshTokenDto } from './validation/refreshTokenDto';
import { LoginDto } from './validation/loginDto';
import Tokens from './types/tokens';

@ApiTags('auth')
@Controller('auth')
export class AuthController 
{
	constructor(
		private authService: AuthService,
	) {
		//
	}

	@Post('register')
	async register(@Body() body: CreateUserDto): Promise<Tokens> {
		return await this.authService.register(body.email, body.password, body.lang);
	}

	@ApiBody({ type: LoginDto })
	@UseGuards(LocalAuthGuard)
	@Post('login')
	@HttpCode(200)
	async login(@Request() req): Promise<Tokens> {
		return this.authService.login(req.user);
	}

	@Post('refresh')
	refreshToken(@Body() body: RefreshTokenDto): Promise<Tokens> {
		return this.authService.refreshToken(body.email, body.refreshToken);
	}
}